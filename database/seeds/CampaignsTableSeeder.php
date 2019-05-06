<?php

use App\Account;
use App\Campaign;
use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $account = Account::first();
        
        $campaignOne = Campaign::create([
            'account_id' => $account->id,
            'name' => 'Pet Products'

        ]);

        $campaignOne->resources()->attach(2);
        $campaignOne->resources()->attach(3);

        

    }
}
