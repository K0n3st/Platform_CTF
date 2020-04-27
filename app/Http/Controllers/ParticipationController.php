<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Competition;
use App\Participation;
use App\ParticipationTeam;
use App\Team;
use DB;
use Auth;

class ParticipationController extends Controller
{
    public function create(Competition $competition){
        return view('participate',[
            'competition' => $competition
        ]);
    }

    public function store(Request $request, Competition $competition){
        $participation = new Participation();
        $participation->user()->associate(Auth::user());
        $participation->competition()->associate($competition);
        $participation->save();

        return redirect('/competition/'. $competition->id);
    }

    public function teamParticipate(Request $request, Competition $competition){
        return view('team.selectOptionTeam', [
            'competition' => $competition,
        ]);
    }

    public function register(Request $request, Competition $competition){
        return view('team.registerTeam', [
            'competition' => $competition,
        ]);
    }

    public function login(Request $request, Competition $competition){
        return view('team.loginTeam', [
            'competition' => $competition,
        ]);
    }

    public function registerTeamParticipation(Request $request, Competition $competition){

        /* Crear Equipo */
        $team_name = $request->input('name');
        $team = new Team();
        $team->name = $team_name;
        $team->password = $request->input('password');
        $team->user_id = Auth::user()->id;
        $team->competition_id = $competition->id;
        $team->save();

        $team_id = DB::table('teams')->select('id')->where('name', $team_name)->where('competition_id', $competition->id)->get()->first();
        $team_id = $team_id->id;

        /* Introducir Jugadores en equipo */
        if($team->users->where('id', intval(Auth::user()->id))->count()) {
            $user = $team->challenges->where('id', intval(Auth::user()->id))->first();
            $user->pivot->competition_id = $competition->id;
            $user->pivot->save();
        } else {
            $team->users()->attach(Auth::user()->id, ['competition_id' => $competition->id]);
        }

        /* Crear participacion equipo */
        $participationTeam = new ParticipationTeam();
        $participationTeam->team_id = $team_id;
        $participationTeam->competition()->associate($competition);
        $participationTeam->save();

        return redirect('/competition/'. $competition->id);
    }

    public function loginTeamParticipation(Request $request, Competition $competition){
        $team_name = $request->input('name');
        $password = $request->input('password');

        $team = Team::where('name', $team_name)->where('competition_id',$competition->id)->where('password',$password)->first();

        if(empty($team)){
            return redirect('/competition/'. $competition->id);
        }

        /* Introducir Jugadores en equipo */
        $team->users()->attach(Auth::user()->id, ['competition_id' => $competition->id]);

        return redirect('/competition/'. $competition->id);
    }

}
