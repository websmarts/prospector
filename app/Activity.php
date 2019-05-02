<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
    
        'campaign_id',
        'prospect_id',
        'parent_id',
        'contact_id',
        'activity',
        'note',
        'due',
        'status',
        'created_by',
        'assigned_to'
    ];

    
    protected $casts = [
        'due' => 'datetime'
    ];

    public function prospect()
    {
        return $this->belongsTo('App\CampaignProspect');
    }

}
