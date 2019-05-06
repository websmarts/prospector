<?php

namespace App\Http\Controllers;

use App\User;
use App\Campaign;

use App\Prospect;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CampaignController extends Controller
{
    

    
    public function index()
    {
        
        
        return view('campaign.index');
    }

    public function store(Request $request)
    {
        // Validate request
        // dd($request->all());

        $user = $request->user();

        $campaign = Campaign::where('name',$request->campaign_name)->where('account_id',$user->account_id)->first();

        // Users as resources for campaign - just get all account users
        $users = User::where('account_id',$user->account_id)->get();

        

        if(!$campaign){
            $campaign = Campaign::create([
                'name' => $request->campaign_name,
                'account_id' => $user->account_id
            ]);
        }

        // attache the account users to campaign resources
        foreach($users as $user){
            $campaign->resources()->attach($user->id);
        }
        

       
        

        
        $data = Excel::toArray(null, request()->file('prospects'));

        // discard header row

        $rows = $data[0]; // first worksheet data
        unset($rows[0]);

        //dd($rows);

        foreach($rows as $row){
            //dd($row);
            $prospect = Prospect::create([
                'account_id' => $user->account_id,
                'name' => $row[1],
                'address1' => $row[2],
                'city' => $row[3],
                'postcode' =>$row[5],
                'state' =>$row[4],
                'country' => 'Australia',
                'phone' => $row[6],
                'email' => $row[8]
                

            ]);

        // dd($prospect);

            $prospect->campaigns()->attach($campaign->id);

        
        }

        dd('done');

        // Create the campaign
    }
}
