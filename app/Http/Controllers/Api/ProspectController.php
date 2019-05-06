<?php

namespace App\Http\Controllers\Api;





use App\Prospect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProspectController extends Controller
{
    public function fetch(Request $request, Prospect $prospect)
    {       
        if(!$campaignId = $request->campaign){
            return response()->json(['message'=>'No campaign specified'],422);
        };

        
        
        return response()->json(['data' => $this->transform($prospect,$campaignId)]);
    }

    
    public function update(Request $request, Prospect $prospect){

        // extract the prospect data out of the request data
        //$prospect->updateFillables($request);

        
        if(!$campaignId = $request->campaign){
            return response()->json(['message'=>'No campaign specified'],422);
        };

        $prospect->update($request->all());


        $prospect->campaigns()->updateExistingPivot($campaignId, [
            'status'=> $request->campaign_status,
            'note' => $request->campaign_note
            ]);
        
        

        return response()->json(['data' => $this->transform($prospect,$campaignId)]);
    }

    protected function transform(Prospect $prospect, $campaignId){

        // Gather prospects campaign_status and campaign_note
        $campaign = $prospect->campaigns()->get()->where('pivot.campaign_id',$campaignId)->first();
        
        $data['activities'] = $prospect->activities()->get();
        
        $data['contacts'] = $prospect->contacts()->get();
        

        

        $data['prospect'] = $prospect->toArray();
        $data['prospect']['campaign_id'] = $campaign->id;
        $data['prospect']['campaign_note'] = $campaign->pivot->note;
        $data['prospect']['campaign_status'] = $campaign->pivot->status;


        return $data;

    }


}