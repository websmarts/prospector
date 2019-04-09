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
        
        Campaign::create([
            'account_id' => $account->id,
            'name' => 'Pet Products'

        ]);

        Campaign::create([
            'account_id' => $account->id,
            'name' => 'Promo Products'

        ]);
    }
}
