<?php

namespace App\Http\Controllers\Api;





use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    
    
    public function update(Request $request, Activity $activity)
    {

        $activity->update($request->all());

        $activity->refresh();
        
        

        return response()->json(['data' => $activity]);
    }

    public function store(Request $request)
    {
        //$prospect = Prospect::find($request->prospect_id);

        $activity = Activity::create($request->all());

        return response()->json(['data' => $activity]);
    }

   


}