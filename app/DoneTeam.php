<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoneTeam extends Model
{
    public function participationTeam(){
        return $this->belongsTo('App\ParticipationTeam');
    }

    public function challenge(){
        return $this->belongsTo('App\Challenge');
    }

    public function getTeam(){
        return $this->participationTeam->team;
    }
}
