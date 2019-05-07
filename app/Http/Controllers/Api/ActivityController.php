<?php

namespace App\Http\Controllers\Api;





use App\Activity;
use App\Prospect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    
    
    public function update(Request $request, Activity $activity)
    {

        $this->updateProspectCampaignStatus($request);
        


        $activity->update($request->all());

        $activity->refresh();  

        return response()->json(['data' => $activity]);
    }

    public function store(Request $request)
    {
        //$prospect = Prospect::find($request->prospect_id);

        $data = $request->all();

        $data['status'] = (int) $request->input('status')?:0;


        $activity = Activity::create($data);
        

        return response()->json(['data' => $activity]);
    }

    protected function updateProspectCampaignStatus($request)
    {
        $prospect = Prospect::find($request->prospect_id);

        $prospectCampaign = $prospect->campaigns()->where('campaign_prospect.campaign_id',$request->campaign_id)->first();

        if($request->filled('campaign_status') ){
            $prospect->campaigns()->updateExistingPivot($request->campaign_id,['status'=>$request->campaign_status]);
            
        }
    }

   


}