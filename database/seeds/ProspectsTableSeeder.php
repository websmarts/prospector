<?php

use App\Account;
use App\Contact;
use App\Activity;
use App\Campaign;
use App\Prospect;
use Carbon\Carbon;
use Faker\Factory as Faker;
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

            

            
        
            $prospect = Prospect::create([
                    'name' => $c->name,                  
                    'address1' => $c->address1,
                    'address2' => $c->address2,
                    'address3' => $c->address3,
                    'city' => $c->city,
                    'postcode' => $c->postcode,
                    'state' => $c->state,
                    'country' => $c->country
                    
                ]);

            // Attach prospect to a campaign
            $cid = rand(1,2); // fake a campaign->id to attach
            $campaign = Campaign::find($cid);

            $prospect->refresh();
            $campaign->prospects()->attach($prospect->id,['note'=>'my note','status'=>0]);
            $faker = Faker::create();

            

            
            if(!empty($c->contacts)){

                $contact = Contact::create([
                    'prospect_id'=>$prospect->id,
            
                    'name' => $c->contacts,
                    'phone' => $c->phone,
                    'mobile' => $c->mobile,
                    'email' => $c->email_1 
                    
                ]);

            } else {
                $contact = false;
            }

            // Create an activity for the campaign for the prospect
            $activity = Activity::create([

                'parent_id' => 0,
                'campaign_id' => $campaign->id,
                'prospect_id' => $prospect->id,
                'activity' => 'do something with '.$prospect->name,
                'note' => $faker->paragraph,
                'due' => Carbon::now()->subDays(rand(-30,30)),
                'contact_id' => $contact ? $contact->id : null,
                'created_by' => rand(2,3),
                'assigned_to' => rand(2,3)


            ]);

            // if $contact is not null then create a campaign contact for this prospect
            if($contact){
                $campaign->contacts()->save($contact);
            }

            $campaign->activities()->save($activity);

            

            
        }
    }
}
