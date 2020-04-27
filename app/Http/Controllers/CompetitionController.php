<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Competition;
use App\Category;
use App\Challenge;
use App\Participation;
use App\Done;
use App\DoneTeam;
use App\Hint;
use App\ParticipationTeam;
use App\UsedHint;
use App\UsedHintTeam;
use DB;
use Carbon\Carbon;



class CompetitionController extends Controller
{
    public function index(){
        $competitions = Competition::orderBy('start_date', 'DESC')->orderBY('created_at', 'DESC')->get();
        return view('competitions', [
            'competitions' => $competitions,
        ]);
    }

    public function show(Competition $competition){
        if($competition->playmode == 'individual'){
            if (Participation::where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->get()->isEmpty())
                return redirect('/participate/'. $competition->id. '/create');

            $categories_ids = $competition->challenges->pluck('category_id')->all();
            $categories = Category::find($categories_ids);

            $data = DB::table('participations')
            ->join('competitions', 'participations.competition_id', 'competitions.id')
            ->join('users', 'participations.user_id', 'users.id')
            ->select('users.username', 'users.id','participations.points', 'participations.latest_submit','competitions.name','competitions.description')
            ->where('competitions.id', $competition->id)
            ->orderBy('participations.points', 'DESC')
            ->orderBy('users.username', 'DESC')
            ->get();

            return view('competition', [
                'competition' => $competition,
                'categories' => $categories,
                'data' => $data,
            ]);
        }else{
            /* Comprobamos que el usuario está en un equipo */
            $data = DB::select('SELECT team_user.id from users, team_user where team_user.user_id = users.id AND users.id = '.Auth::user()->id.'');

            /*  Comprobamos que el equipo está en la competición seleccionada */
            $data2 = DB::table('participation_teams')
            ->join('teams', 'participation_teams.team_id', 'teams.id')
            ->join('competitions', 'competitions.id', 'teams.competition_id')
            ->where('competitions.id', $competition->id)
            ->get();

            $categories_ids = $competition->challenges->pluck('category_id')->all();
            $categories = Category::find($categories_ids);

            if(!empty($data)){
                if (!empty($data2))
                    $data = DB::table('participation_teams')
                    ->join('competitions', 'participation_teams.competition_id', 'competitions.id')
                    ->join('teams', 'participation_teams.team_id', 'teams.id')
                    ->select('teams.name as nameTeam', 'teams.id','participation_teams.points', 'participation_teams.latest_submit','competitions.name','competitions.description')
                    ->where('competitions.id', $competition->id)
                    ->orderBy('participation_teams.points', 'DESC')
                    ->orderBy('teams.name', 'DESC')
                    ->get();

                    return view('competition', [
                        'competition' => $competition,
                        'categories' => $categories,
                        'data' => $data,
                    ]);
                return view('participateTeam', [
                    'competition' => $competition,
                ]);
            }else{
                return view('participateTeam', [
                    'competition' => $competition,
                ]);
            }

            $data = DB::table('participations_teams')
            ->join('competitions', 'participations.competition_id', 'competitions.id')
            ->join('teams', 'participations_teams.team_id', 'teams.id')
            ->select('teams.name', 'teams.id','participations_teams.points', 'participations_teams.latest_submit','competitions.name','competitions.description')
            ->where('competitions.id', $competition->id)
            ->orderBy('participations_teams.points', 'DESC')
            ->orderBy('teams.name', 'DESC')
            ->get();

            return view('competition', [
                'competition' => $competition,
                'categories' => $categories,
                'data' => $data,
            ]);
        }
    }


    public function showChallenge(Competition $competition, Challenge $challenge, UsedHint $usedHint){
        if($competition->playmode == 'individual'){
            if (Participation::where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->get()->isEmpty())
                return redirect('/participate/'. $competition->id);

            if (count($competition->challenges->where('id', $challenge->id))){
                $hints = Hint::where('challenge_id', $challenge->id)->get();

                $used_hints = DB::table('used_hints')
                    ->join('hints', 'hints.id', 'used_hints.hints_id')
                    ->join('challenges', 'challenges.id', 'hints.id')
                    ->join('users', 'used_hints.users_id', 'users.id')
                    ->select('*')
                    ->where('used_hints.challenge_id', $challenge->id)
                    ->where('users.id', Auth::user()->id)
                    ->orderBy('used_hints.hints_id', 'ASC')
                    ->get();

                return view('challenge', [
                    'challenge' => $challenge,
                    'competition' => $competition,
                    'hints' => $hints,
                    'used_hints' => $used_hints,
                ]);
            } else{
                return "What are you doing?";
            }
        }else{
            if (count($competition->challenges->where('id', $challenge->id))){
                $hints = Hint::where('challenge_id', $challenge->id)->get();

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
            $used_hints = DB::table('used_hint_teams')
                ->join('hints', 'hints.id', 'used_hint_teams.hints_id')
                ->join('challenges', 'challenges.id', 'hints.id')
                ->join('teams', 'used_hint_teams.team_id', 'teams.id')
                ->select('*')
                ->where('used_hint_teams.challenge_id', $challenge->id)
                ->where('teams.id', $team_user)
                ->orderBy('used_hint_teams.hints_id', 'ASC')
                ->get();

            return view('challenge', [
                'challenge' => $challenge,
                'competition' => $competition,
                'hints' => $hints,
                'used_hints' => $used_hints,
                'solved' => $solved,
            ]);
            }else{
                return "What are you doing?";
            }
        }
    }

    public function submitChallenge(Competition $competition, Challenge $challenge, Request $request){
        if($competition->playmode == 'individual'){
            if (Participation::where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->get()->isEmpty())
                return redirect('/participate/'. $competition->id);

            if(!count($competition->challenges->where('id',$challenge->id)))
                return "What are you doing?";
            
                $challenge = $competition->challenges->where('id', intval($challenge->id))->first();

            $used_hints = count(UsedHint::where('users_id', Auth::user()->id)->where('used_hints.challenge_id',$challenge->id)->get());

            if($used_hints == 1){
                $points_challenge_final = ($challenge->pivot->points - ($challenge->points * 0.10));
            }elseif($used_hints == 2){
                $points_challenge_final = ($challenge->pivot->points - ($challenge->points * 0.25));
            }elseif($used_hints == 3){
                $points_challenge_final = ($challenge->pivot->points - ($challenge->points * 0.50));
            }else{
                $points_challenge_final = $challenge->pivot->points;
            }

            $answer = $request->input('flag');
            $status = ($answer == $challenge->flag);

            if($status == 1){
                $points_challenge = $points_challenge_final;
                $points_user_participation = Participation::where('user_id', Auth::user()->id)->where('competition_id',$competition->id)->first()->points;

                $points_total = ($points_challenge + $points_user_participation);

                Participation::where('user_id',Auth::user()->id)->where('competition_id',$competition->id)->update(['points'=> $points_total,'latest_submit'=> Carbon::now()]);
            }

            /* Introducir resultado */
            $done = new Done;
            $done->participation_id = Participation::where('user_id',Auth::user()->id)->where('competition_id',$competition->id)->first()->id;
            $done->challenge_id = $challenge->id;
            $done->flag = $answer;
            $done->status = $status;
            $done->time = Carbon::now();

            $done->save();

            return view('challenge', [
                'challenge' => $challenge,
                'competition' => $competition,
                'status' => $status,            
            ]);
        }else{
            if(!count($competition->challenges->where('id',$challenge->id)))
            return "What are you doing?";
        
            $challenge = $competition->challenges->where('id', intval($challenge->id))->first();
            $team_user = DB::table('team_user')->select('team_id')->where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->get();
            $team_user = $team_user[0]->team_id;

            $used_hints = count(UsedHintTeam::where('team_id', $team_user)->where('used_hint_teams.challenge_id',$challenge->id)->get());

            if($used_hints == 1){
                $points_challenge_final = ($challenge->pivot->points - ($challenge->points * 0.10));
            }elseif($used_hints == 2){
                $points_challenge_final = ($challenge->pivot->points - ($challenge->points * 0.25));
            }elseif($used_hints == 3){
                $points_challenge_final = ($challenge->pivot->points - ($challenge->points * 0.50));
            }else{
                $points_challenge_final = $challenge->pivot->points;
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

            $answer = $request->input('flag');
            $status = ($answer == $challenge->flag);

            if($status == 1){
                $points_challenge = $points_challenge_final;
                $points_user_participation = ParticipationTeam::where('team_id', $team_user)->where('competition_id',$competition->id)->first()->points;

                $points_total = ($points_challenge + $points_user_participation);

                ParticipationTeam::where('team_id', $team_user)->where('competition_id',$competition->id)->update(['points'=> $points_total,'latest_submit'=> Carbon::now()]);
            }

            /* Introducir resultado */
            $done = new DoneTeam;
            $done->participation_team_id = ParticipationTeam::where('team_id', $team_user)->where('competition_id',$competition->id)->first()->id;
            $done->challenge_id = $challenge->id;
            $done->flag = $answer;
            $done->status = $status;
            $done->time = Carbon::now();

            $done->save();

            return view('challenge', [
                'challenge' => $challenge,
                'competition' => $competition,
                'status' => $status,
                'team_user' => $team_user,
                'solved' => $solved,

            ]);
        }
    }

    public function showLeaderboard(Competition $competition){
        if($competition->playmode == 'individual'){
            $data = DB::table('participations')
            ->join('competitions', 'participations.competition_id', 'competitions.id')
            ->join('users', 'participations.user_id', 'users.id')
            ->select('users.username', 'users.id','participations.points', 'participations.latest_submit','competitions.name','competitions.description')
            ->where('competitions.id', $competition->id)
            ->orderBy('participations.points', 'DESC')
            ->orderBy('users.username', 'DESC')
            ->get();

            return view('leaderboard', [
                'data' => $data,
                'competition' => $competition,
            ]);
        }else{
            $data = DB::table('participation_teams')
            ->join('competitions', 'participation_teams.competition_id', 'competitions.id')
            ->join('teams', 'participation_teams.team_id', 'teams.id')
            ->select('teams.name as nameTeam', 'teams.id','participation_teams.points', 'participation_teams.latest_submit','competitions.name','competitions.description')
            ->where('competitions.id', $competition->id)
            ->orderBy('participation_teams.points', 'DESC')
            ->orderBy('teams.name', 'DESC')
            ->get();

            return view('leaderboard', [
                'data' => $data,
                'competition' => $competition,
            ]);
        }
    }
}
