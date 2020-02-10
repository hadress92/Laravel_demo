<?php

namespace App\Http\Controllers;

use App\InsurancePayments;
use App\Service;
use App\Traits\FuelEntriesTrait;
use App\Traits\InsuranceTrait;
use App\Traits\ServicesTrait;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    use ServicesTrait, InsuranceTrait, FuelEntriesTrait;

    public function getVehicles(Request $request, $name)
    {
        $type = $request->request->get('type');
        $min_cost = $request->request->get('min_cost');
        $max_cost = $request->request->get('max_cost');
        $min_date = $request->request->get('min_date');
        $max_date = $request->request->get('max_date');
        $limit = $request->request->get('limit') ?: 10;
        $offset = $request->request->get('offset') ?: 1;

        $services = self::getServicesApiResults($name, $min_cost, $max_cost, $min_date, $max_date, $limit, $offset);

        $insurance = self::getInsurancePaymentsApiResults($name, $min_cost, $max_cost, $min_date, $max_date, $limit, $offset);

        $fuel = self::getFuelEntriesApiResults($name, $min_cost, $max_cost, $min_date, $max_date, $limit, $offset);

        $result['expenses'] = [];

        if (isset($type)){
            $types = explode(',',$type);
            if (in_array('service',$types)){
                $result['expenses'] = array_merge($result['expenses'], json_decode($services, true));
            }
            if (in_array('insurance',$types)){
                $result['expenses'] = array_merge($result['expenses'], json_decode($insurance, true));
            }
            if (in_array('fuel',$types)){
                $result['expenses'] = array_merge($result['expenses'], json_decode($fuel, true));
            }
        }

        return $result;
    }

}
