<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['account_id', 'name'];

    public function prospects()
    {
        return $this->belongsToMany('App\Prospect')->withPivot('status','note')->withTimestamps();
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function resources()
    {
        return $this->belongsToMany('App\User');
    }

    
}
