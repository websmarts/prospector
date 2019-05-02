<?php

namespace App\Http\Controllers\Api;



use App\CampaignProspect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        

        // Get all the relevant Account Data
        // $account = auth()->user()->account()
        // ->with('campaigns','campaigns.prospects','campaigns.contacts','campaigns.activities','campaigns.resources','campaigns.prospects.contacts')->first();

        $data['account'] = auth()->user()->account()->first();

        $data['user'] = auth()->user();
        $campaigns = $data['account']->campaigns;
        $data['campaigns'] = $campaigns->toArray();

        $data['prospects'] = collect();  
        $data['activities']  = collect();
        $data['contacts'] = collect();
        $data['resources'] = collect();

        foreach($campaigns as $campaign){

            // Flatten Campaign prospects
            $data['prospects'] = $data['prospects']->merge($campaign->prospects->map(function($item,$key){
                $item->campaign_id = $item->pivot->campaign_id;
                $item->campaign_note = $item->pivot->note;
                $item->campaign_status = $item->pivot->status;
                unset($item->pivot);
                return $item;

            }));

            // Flatten Campaign Contacts
            $data['contacts'] = $data['contacts']->merge($campaign->contacts->map(function($item,$key){
                $item->campaign_id = $item->pivot->campaign_id;
                unset($item->pivot);
                unset($item->created_at);
                unset($item->updated_at);
                unset($item->deleted_at);
                return $item;
            }));
        
               
            // Campaign Activities
            $data['activities'] = $data['activities']->merge($campaign->activities);

            // Campaign Resources
            $data['resources'] = $data['resources']->merge($campaign->resources->map(function($item,$key){
                $replace = new \stdClass;
                
                $replace->user_id = $item->id;
                $replace->campaign_id = $item->pivot->campaign_id;// flatten campign_id in
                $replace->name = $item->name;
                unset($item);
                return $replace;
                
            }));
            

        }    
        
        
        return response()->json(['data' => $data]);
    }
}
