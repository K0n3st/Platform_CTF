<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hint extends Model
{
    public function competitions(){
        return $this->belongsToMany('App\Competition');
    }

    public function challenge(){
        return $this->belongsTo('App\Challenge');
    }

    public function used_hints(){
        return $this->hasMany('App\Challenge');
    }
}
