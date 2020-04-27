<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function participations() {
    	return $this->hasMany('App\ParticipationTeam');
    }

    public function competitions() {
    	return $this->hasMany('App\Competition');
    }

    public function dones() {
        return $this->hasManyThrough('App\DoneTeam', 'App\ParticipationTeam');
    }

    public function used_hint() {
        return $this->hasMany('App\UsedHintTeam');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('team_id');
    }
    
    public function hasSolved(Challenge $challenge) {
        return $this->dones->where('status', 1)->where('challenge_id', $challenge->id)->count();
    }

}
