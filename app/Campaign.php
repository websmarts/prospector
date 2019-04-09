<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['account_id', 'name'];

    public function prospects()
    {
        return $this->belongsToMany('App\Prospect');
    }

    public function campaignProspect() {
        return $this->hasMany('App\Prospect')->using('App\CampaignProspect');
    }
}
