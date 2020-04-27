<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','ip','team_id','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function participations() {
    	return $this->hasMany('App\Participation');
    }

    public function competitions() {
    	return $this->hasMany('App\Competition');
    }

    public function dones() {
        return $this->hasManyThrough('App\Done', 'App\Participation');
    }

    public function used_hint() {
        return $this->hasMany('App\Used_Hint');
    }

    public function teams(){
        return $this->belongsToMany('App\Team')->withPivot('user_id');
    }

    public function score(Competition $competition) {
        $participation = Participation::where('user_id', $this->id)
                                        ->where('competition_id', $competition->id)
                                        ->first()->id;
        $correctChallenge = Done::where('participation_id', $participation)
                                        ->where('status', 1)
                                        ->pluck('challenge_id')
                                        ->all();

        $total = 0;

        foreach($competition->challenges->wherein('id', $correctChallenge) as $t) {
            $total += $t->pivot->points;
        }
        return $total;
    }

    public function isParticipate(Competition $competition) {
        if($competition->playmode == 'individual'){
            $participated = $this->participations->pluck('competition_id');
            return $participated->contains($competition->id);
        }else{
            $data = DB::select('SELECT id from team_user where user_id = '.Auth::user()->id.' AND competition_id = '.$competition->id . '');
            if(empty($data)){
                $data = 0;
            }else{
                $data = $data[0]->id;
            }

            if($data != 0){
                return true;
            }else{
                return false;
            }
        }
    }

    public function hasSolved(Challenge $challenge) {
        return $this->dones->where('status', 1)->where('challenge_id', $challenge->id)->count();
    }

    public function hasSolvedTeam(Competition $competition,Challenge $challenge) {
        $team_user = DB::table('team_user')->select('team_id')->where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->get();

        if(empty($team_user)){
            $team_user = 0;
        }else{
            $team_user = $team_user[0]->team_id;
        }

        $query = DoneTeam::select('status')->where('participation_team_id', $team_user)->where('challenge_id', $challenge->id)->first();

        if(empty($query)){
            $query = 0;
        }else{
            $query = $query->status;
        }
        if($query == 1){
            $solved = true;
        }else{
            $solved = false;
        }
        return $solved;
    }

    public function getTotalScore(){
        $total = 0;
        $participations = Participation::where('user_id', $this->id)->get();

        foreach ($participations as $participation) {
            $total += $this->score($participation->competition);
        }

        return $total;
    }

    public function isAdmin() {
        return $this->type === 1;
    }

    public function getLatestSubmitTime($competition) {
        $latestSubmit =  $this->dones->where('status', 1)
                    ->sortByDesc('time')
                    ->first();

        return $latestSubmit['time'];
    }

    public function isBanned(){
        return $this->banned === 1;
    }
}
