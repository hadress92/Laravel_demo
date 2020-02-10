<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * Get the services for the Vehicle.
     */
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    /**
     * Get the insurancePayments for the Vehicle.
     */
    public function insurancePayments()
    {
        return $this->hasMany('App\InsurancePayments');
    }

    /**
     * Get the fuelEntries for the Vehicle.
     */
    public function fuelEntries()
    {
        return $this->hasMany('App\fuelEntries');
    }
}
