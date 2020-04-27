<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipationTeam extends Model
{
    public function Team(){
        return $this->belongsTo('App\Team');
    }

    public function competition(){
        return $this->belongsTo('App\Competition');
    }

    public function dones(){
        return $this->hasMany('App\Done');
    }
}
