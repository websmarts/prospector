<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'account_id',
        'card_id',
        'contact_role',
        'name',
        'phone',
        'mobile',
        'email'
        
    ];
}

