<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'prospect_id',
        'name',
        'phone',
        'mobile',
        'email',
        'note'
        
    ];


    public function campaigns()
    {
        return $this->belongsToMany('App\Campaign')->withPivot('contact_role');
    }
}

