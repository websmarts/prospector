<?php

use App\Activity;
use App\CampaignProspect;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $campaignProspects = CampaignProspect::take(20)->get();
        
        foreach($campaignProspects as $cp){

            //dd($cp->prospect);

            $activity = new Activity;

            $activity->account_id = $cp->prospect->account_id;
            //$activity->campaign_prospect_id = $cp->id;
            $activity->parent_id = 0;
            $activity->contact_id = $cp->prospect->contact_id ? $cp->prospect->contact_id :0;
            $activity->activity = 'Followup call';
            $activity->note = 'Keen on waffles but not keen on biscuits';
            $activity->due = Carbon::now()->subDays(rand(1,30));
            $activity->status = 0;

            // $activity->save();
            // $activity->refresh();

            
            $cp->activities()->save($activity);
        }
    }
}
