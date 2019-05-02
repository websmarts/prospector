<?php

namespace App\Http\Controllers\Api;





use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    
    
    public function update(Request $request, Contact $contact){

        $contact->update($request->all());
        return response()->json(['data' => $contact]);
    }

    public function store(Request $request){

        $contact = Contact::create($request->all());
        

        return response()->json(['data' => $contact]);
    }

    


}