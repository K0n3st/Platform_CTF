<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Competition;
use App\Challenge;
use App\Team;
use App\User;
use DB;


class CompetitionController extends Controller
{

    public function index(){
        $competitions = Competition::orderBY('start_date', 'DESC')->orderBY('id', 'DESC')->get();
        return view('dashboard.admin.competition.index', [
            'competitions' => $competitions
        ]);
    }

    public function create(){
        return view('dashboard.admin.competition.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $competition = new Competition;
        $competition->name = $request->input('name');
        $competition->description = $request->input('description');
        $competition->start_date = $request->input('start_date');
        $competition->end_date = $request->input('end_date');
        $competition->enabled = $request->input('enabled');
        $competition->visible = $request->input('visible');
        $competition->playmode = $request->input('playmode');


        $competition->save();

        return redirect('admin/competition/' . $competition->id . '/edit');
    }

    public function show($id){
        return view('dashboard.admin.competition.show', [
                'competition' => Competition::find($id)
        ]);
    }

    public function edit($id){
        $competition = Competition::find($id);
        if($competition->playmode == 'individual'){
            $users = User::find($competition->participations->pluck('user_id')->all());

            $data = DB::table('participations')
            ->join('competitions', 'participations.competition_id', 'competitions.id')
            ->join('users', 'participations.user_id', 'users.id')
            ->select('users.username', 'users.id','participations.points', 'participations.latest_submit','competitions.name','competitions.description')
            ->where('competitions.id', $competition->id)
            ->orderBy('participations.points', 'DESC')
            ->orderBy('users.username', 'DESC')
            ->get();

            return view('dashboard.admin.competition.edit', [
                    'competition' => $competition,
                    'challenges' => Challenge::all(),
                    'users' => $users,
                    'data' => $data,
            ]);
        }else{
            $teams = Team::find($competition->participationteams->pluck('team_id')->all());

            $data = DB::table('participation_teams')
            ->join('competitions', 'participation_teams.competition_id', 'competitions.id')
            ->join('teams', 'participation_teams.team_id', 'teams.id')
            ->select('teams.name as nameTeam','participation_teams.points', 'participation_teams.latest_submit')
            ->where('competitions.id', $competition->id)
            ->orderBy('participation_teams.points', 'DESC')
            ->orderBy('teams.name', 'DESC')
            ->get();

            return view('dashboard.admin.competition.edit', [
                    'competition' => $competition,
                    'challenges' => Challenge::all(),
                    'teams' => $teams,
                    'data' => $data,
            ]);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $competition = Competition::find($id);
        $competition->name = $request->input('name');
        $competition->description = $request->input('description');
        $competition->start_date = $request->input('start_date');
        $competition->end_date = $request->input('end_date');
        $competition->playmode = $request->input('playmode');

        $competition->save();

        return back();
    }


    public function addChallenge(Request $request, Competition $competition)
    {
        $challengeId = $request->input('challenge_id');
        $points = $request->input('challenge_points');
        if($competition->challenges->where('id', intval($challengeId))->count()) {
            $challenge = $competition->challenges->where('id', intval($challengeId))->first();
            $challenge->pivot->points = $points;
            $challenge->pivot->save();
        } else {
            $competition->challenges()->attach($challengeId, ['points' => $points]);
        }
        return back();
    }

    public function editChallengeHide(Request $request, Competition $competition, Challenge $challenge)
    {
        $competition->challenges()->detach($challenge);

        $points = $request->input('points');
        $competition->challenges()->attach($challenge, ['visible' => 1, 'points' => $points]);
        
        return back();
    }

    public function editChallengeUnHide(Request $request, Competition $competition, Challenge $challenge)
    {
        $competition->challenges()->detach($challenge);

        $points = $request->input('points');
        $competition->challenges()->attach($challenge, ['visible' => 0, 'points' => $points]);
        
        return back();
    }

    public function deleteChallenge(Competition $competition, Challenge $challenge)
    {

        $challenge = Challenge::find($challenge->id);
        $competition->challenges()->detach($challenge);
        return back();
    }

    public function activate($id){
        $competition = Competition::find($id);

        $competition->enabled = 0;
        $competition->save();

        return back();
    }

    public function deactivate($id){
        $competition = Competition::find($id);

        $competition->enabled = 1;
        $competition->save();

        return back();
    }

    public function hide($id){
        $competition = Competition::find($id);

        $competition->visible = 1;
        $competition->save();

        return back();
    }

    public function unhide($id){
        $competition = Competition::find($id);

        $competition->visible = 0;
        $competition->save();

        return back();
    }

    public function destroy($id)
    {
        DB::table('challenge_competition')->where('competition_id', $id)->delete();

        DB::table('participations')->where('competition_id', $id)->delete();

        DB::table('competitions')->where('id', $id)->delete();

        return back();
    }
}