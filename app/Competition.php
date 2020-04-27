<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Competition extends Model
{
    protected $table = 'competitions';

    public function challenges(){
        return $this->belongsToMany('App\Challenge')->withPivot('points','visible', 'start_date', 'end_date');
    }

    public function hints(){
        return $this->belongsToMany('App\Hint');
    }

    public function participations(){
        return $this->hasMany('App\Participation');
    }

    public function participationteams(){
        return $this->hasMany('App\ParticipationTeam');
    }

    public function dones(){
        return $this->hasManyThrough('App\Done', 'App\Participation');
    }

    public function donesteam(){
        return $this->hasManyThrough('App\DoneTeam', 'App\ParticipationTeam');
    }

    public function getParticipants(){
        if($this->playmode == 'individual')
            return User::find($this->participations->pluck('user_id')->all());
        else
            return Team::find($this->participationteams->pluck('team_id')->all());
    }

    public function getCorrectDone(){
        if($this->playmode == 'individual')
            return $this->dones->where('status', 1)->all();
        else
            return $this->donesteam->where('status', 1)->all();

    }

    public function getSortedChallenges(){
        $challenges = $this->challenges;

        $challenges = $challenges->sort(function($a, $b){
            if( count($a->getSolver($this)) === count($b->getSolver($this)) ){
                return $a->id - $b->id;
            }
            return count($a->getSolver($this)) > count($b->getSolver($this)) ? -1 : 1;
        });

        return $challenges;
    }

    public function isOngoing(){
        $now = Carbon::now();
        return ($this->start_date < $now && $now < $this->end_date);
    }

    public function isFinished(){
        return Carbon::now() > $this->end_date;
    }

}
