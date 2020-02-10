<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type'];

    /**
     * Get the Vehicle that owns the Service.
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
        return $this->attributes['type'] = 'service';
    }
}
