<?php

use App\User;
use App\Account;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>  'Administrator',
            'email' => 'admin@k9homes.com.au',
            'password' => bcrypt('pass'),
            'account_id' => 0,
            'email_verified_at' => Carbon::now(),
            'api_token' => Str::random(60),

        ]);

        User::create([
            'name' =>  'Ian Maclagan',
            'email' => 'ian@k9homes.com.au',
            'password' => bcrypt('pass'),
            'account_id' => Account::first()->id,
            'email_verified_at' => Carbon::now(),
            'api_token' => Str::random(60),

        ]);

        User::create([
            'name' =>  'Darren',
            'email' => 'darren@k9homes.com.au',
            'password' => bcrypt('pass'),
            'account_id' => Account::first()->id,
            'email_verified_at' => Carbon::now(),
            'api_token' => Str::random(60),

        ]);
        User::create([
            'name' =>  'Kerry',
            'email' => 'kerry@k9homes.com.au',
            'password' => bcrypt('pass'),
            'account_id' => Account::first()->id,
            'email_verified_at' => Carbon::now(),
            'api_token' => Str::random(60),

        ]);
    }
}
