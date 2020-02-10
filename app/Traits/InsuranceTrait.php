<?php


namespace App\Traits;


use App\InsurancePayments;
use Illuminate\Support\Facades\DB;

trait InsuranceTrait {
    public static function getInsurancePaymentsApiResults($searchTerm = null, $min_cost = null, $max_cost = null, $min_date = null, $max_date = null, $limit = 10, $offset = 1) {
        $query = InsurancePayments::select('insurance_payments.id as id', 'vehicles.name', 'vehicles.plate_number', 'amount as cost', 'insurance_payments.contract_date as created_at')
                                ->join('vehicles', 'vehicles.id', '=', 'insurance_payments.vehicle_id')
                                ->where('vehicles.name', 'LIKE', "%{$searchTerm}%")
                                ->limit($limit)
                                ->offset($offset);
        if ($min_cost){
            $query  ->where('amount', '>=' ,$min_cost);
        }
        if ($max_cost){
            $query  ->where('amount', '<=' ,$max_cost);
        }
        if ($min_date){
            $query  ->where('insurance_payments.contract_date', '<=' ,date($min_date));
        }
        if ($max_date){
            $query  ->where('insurance_payments.contract_date', '<=' ,date($max_date));
        }
        return
            $query->get()
            ->toJSON();
    }
}
