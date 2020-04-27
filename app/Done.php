<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Done extends Model
{

    public function participation(){
        return $this->belongsTo('App\Participation');
    }

    public function challenge(){
        return $this->belongsTo('App\Challenge');
    }

    public function getUser(){
        return $this->participation->user;
    }
}
