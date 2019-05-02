<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name'];

    public function campaigns()
    {
        return $this->hasMany('App\Campaign');
    }
}
