<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $table = 'participations';
    
    public function User(){
        return $this->belongsTo('App\User');
    }

    public function competition(){
        return $this->belongsTo('App\Competition');
    }

    public function dones(){
        return $this->hasMany('App\Done');
    }
}
