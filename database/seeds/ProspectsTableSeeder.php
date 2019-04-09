<?php

use App\Account;
use App\Contact;
use App\Prospect;
use Illuminate\Database\Seeder;

class ProspectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $k9clients = \DB::connection('k9homes')->table('clients')->limit(50)->get();
        $account = Account::first();
        

        foreach($k9clients as $c){

            if(!empty($c->contacts)){

                $contact = Contact::create([
                    'account_id'=>$account->id,
            
                    'name' => $c->contacts,
                    'phone' => $c->phone,
                    'mobile' => $c->mobile,
                    'email' => $c->email_1 
                    
                ]);

            }

            
        
            $prospect = Prospect::create([
                    'name' => $c->name,
                    'account_id' => $account->id,
                    'contact_id' => $contact ? $contact->id : null,
                    'address1' => $c->address1,
                    'address2' => $c->address2,
                    'address3' => $c->address3,
                    'city' => $c->city,
                    'postcode' => $c->postcode,
                    'state' => $c->state,
                    'country' => $c->country
                    
                ]);

            

            
        }
    }
}
