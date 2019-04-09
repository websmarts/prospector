<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CampaignProspect extends Pivot
{
    public $fillable = ['campaign_id','prospect_id','note','status'];


    public function contacts() 
    {
        return $this->belongsToMany('App\CampaignProspectContact','campaign_prospect_contact','campaign_prospect_id','contact_id');
    }

    public function activities() 
    {
        return $this->hasMany('App\Activity','campaign_prospect_id','id');// seems to require keys to be specified
    }

    public function prospect()
    {
        return $this->belongsTo('App\Prospect');
    }
}
