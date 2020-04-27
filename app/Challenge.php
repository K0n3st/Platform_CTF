<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenges';

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function competition(){
        return $this->belongsToMany('App\Category')->withPivot('points', 'start_date', 'end_date');
    }

    public function hints(){
        return $this->hasMany('App\Hints');
    }

    public function dones(){
        return $this->hasMany('App\Done');
    }

    public function getSolver(Competition $competition){
        if($competition->playmode == 'individual')
            return Done::whereIn('participation_id', $competition->participations->pluck('id'))
                ->where('status', 1)
                ->where('challenge_id', $this->id)
                ->orderBy('time', 'asc')
                ->get();
        else
            return DoneTeam::whereIn('participation_team_id', $competition->participationteams->pluck('id'))
            ->where('status', 1)
            ->where('challenge_id', $this->id)
            ->orderBy('time', 'asc')
            ->get();
    }
}
