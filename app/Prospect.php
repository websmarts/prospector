<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = [
        'account_id',
        'name',
        'phone',
        'email',
        'address1',
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

    public function account() {
        return $this->hasOne('App\Account');
    }

    
}

