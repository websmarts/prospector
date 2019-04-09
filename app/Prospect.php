<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = [
        'account_id',
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
        return $this->belongsToMany('App\Campaign')->using('App\CampaignProspect');
    }

    
}

