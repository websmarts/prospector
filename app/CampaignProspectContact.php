<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CampaignProspectContact extends Pivot
{
    
    protected $table = 'campaign_prospect_contacts';

    public $fillable =['campaign_prospect_id','contact_id'];
}
