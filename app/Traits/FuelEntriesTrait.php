<?php


namespace App\Traits;


use App\FuelEntries;
use Illuminate\Support\Facades\DB;

trait FuelEntriesTrait {
    public static function getFuelEntriesApiResults($searchTerm = null, $min_cost = null, $max_cost = null, $min_date = null, $max_date = null, $limit = 10, $offset = 1) {
        $query = FuelEntries::select( DB::raw('fuel_entries.id as id, vehicles.name, vehicles.plate_number, (cost * volume) as cost, fuel_entries.entry_date as created_at'))
                            ->join('vehicles', 'vehicles.id', '=', 'fuel_entries.vehicle_id')
                            ->where('vehicles.name', 'LIKE', "%{$searchTerm}%")
                            ->limit($limit)
                            ->offset($offset);
        if ($min_cost){
            $query  ->where('cost', '>=' ,$min_cost);
        }
        if ($max_cost){
            $query  ->where('cost', '<=' ,$max_cost);
        }
        if ($min_date){
            $query  ->where('fuel_entries.entry_date', '<=' ,date($min_date));
        }
        if ($max_date){
            $query  ->where('fuel_entries.entry_date', '<=' ,date($max_date));
        }
        return
            $query->get()
            ->toJSON();
    }
}
