<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'account_id',
        'campaign_prospect_id',
        'parent_id',
        'contact_id',
        'activity',
        'note',
        'due',
        'status'
    ];

    
    protected $casts = [
        'due' => 'datetime'
    ];

    public function prospect()
    {
        return $this->belongsTo('App\CampaignProspect');
    }

}
