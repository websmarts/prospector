<?php

namespace App\Http\Controllers\Api;

use App\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        
        // Finder info - Cards and contacts
        //  card_id | contact_id |card name| tag_name |contact name | section name |
        $cards = Card::with('section','contacts','tag')->get();

        $data = [];

        foreach($cards as $card){
            $row = [
                'card_id' => $card->id,
                'contact_id' => null,
                'card_name' => $card->name,
                'tag_name' => $card->tag ? $card->tag->name : '',
                'contact_name' =>'',
                'section_name' =>$card->section->name

            ];

            $data[] = $row; // add the first row with no contact

            foreach($card->contacts as $contact){
                $c_row = $row;
                $c_row['contact_name'] = $contact->name;
                $c_row['contact_id'] = $contact->id;

                // Add the card/contact row to data
                $data[] = $c_row;
            }
        }
        
        return ['items' => $data];
    }
}
