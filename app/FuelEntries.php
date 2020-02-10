<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelEntries extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type'];
    /**
     * Get the Vehicle that owns the Payment.
     */
    public function post()
    {
        return $this->belongsTo('App\Vehicle');
    }
    /**
     * Get the type.
     *
     * @return string
     */
    public function getTypeAttribute()
    {
        return $this->attributes['type'] = 'fuel';
    }
}
