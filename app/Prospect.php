<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = [
        'name',
        'addres1',
        'address2',
        'address3',
        'city',
        'postcode',
        'state',
        'country',
        'notes'
        
    ];


    public function campaigns()
    {
        return $this->belongsToMany('App\Campaign')->withPivot('status','note');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function activities() {
        return $this->hasMany('App\Activity');
    }

    
}

