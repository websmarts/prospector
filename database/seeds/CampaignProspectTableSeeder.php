<?php

use App\Account;
use App\Campaign;
use App\Prospect;
use App\CampaignProspect;
use Illuminate\Database\Seeder;

class CampaignProspectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add every Prospect to the Pet Products campaign
        $account = Account::first();
        $campaign = Campaign::where('account_id',$account->id)->where('name','Pet Products')->first();
        $prospects = Prospect::where('account_id',$account->id)->get();

        foreach($prospects as $prospect){
            // Assign prospect to Campaign
            $prospect->campaigns()->attach($campaign->id,['note'=>'imported by seeder','status'=>'warm']);
            
            
            // if the prospect has a contact_id , ie it is not null, then
            // assign that contact as the campaignprospect contact

            if($prospect->contact_id){
                $campaignProspect = CampaignProspect::where('prospect_id',$prospect->id)->first();
                
                
                $campaignProspect->contacts()->attach($prospect->contact_id);
            }

        }
    }
}
