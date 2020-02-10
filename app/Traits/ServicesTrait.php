<?php


namespace App\Traits;


use App\Service;
use Illuminate\Support\Facades\DB;

trait ServicesTrait {
    public static function getServicesApiResults($searchTerm = null, $min_cost = null, $max_cost = null, $min_date = null, $max_date = null, $limit = 10, $offset = 1) {
       $query = Service::select( DB::raw('services.id as id, vehicles.name, vehicles.plate_number, (total - (tax + discount)) as cost, services.created_at as created_at'))
               ->join('vehicles', 'services.vehicle_id', '=', 'vehicles.id')
               ->where('vehicles.name', 'LIKE', "%{$searchTerm}%")
               ->limit($limit)
               ->offset($offset);
       if ($min_cost){
            $query  ->where('total', '>' ,$min_cost);
       }
       if ($max_cost){
            $query  ->where('total', '<' ,$max_cost);
       }
       if ($min_date){
            $query  ->where('services.created_at', '<=' ,date($min_date));
       }
        if ($max_date){
            $query  ->where('services.created_at', '<=' ,date($max_date));
        }
        return  $query->get()
                ->toJSON();
    }
}
