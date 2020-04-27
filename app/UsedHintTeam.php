<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedHintTeam extends Model
{
    public function hint(){
        return $this->belongsTo('App\Challenge');
    }

    public function team(){
        return $this->belongsTo('App\Team');
    }
}
