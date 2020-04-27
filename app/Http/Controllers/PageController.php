<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;
use App\Competition;
use App\Category;
use App\User;
use App\Challenge;
use App\Hint;
use DB;
use Auth;




class PageController extends Controller
{
    public function home(){
        if(empty(Config::where('key', 'headlineCompetition')->first()->value)){
            $headlineCompetitionId = '-';
            $lastWeekCompetitionId = '-';
        }else{
            $headlineCompetitionId = Config::where('key', 'headlineCompetition')->first()->value;
            $lastWeekCompetitionId = Config::where('key', 'lastWeekCompetition')->first()->value;
        }

        $headlineCompetition = Competition::find($headlineCompetitionId);
        
        if($lastWeekCompetitionId == -1){
            $showLastWeekLeaderboard = False;
            $lastWeekCompetition = null;
        } else{
            $showLastWeekLeaderboard = True;
            $lastWeekCompetition = Competition::find($lastWeekCompetitionId);
        }

        $competitions = Competition::limit(2)->orderBY('created_at', 'DESC')->get();
        $categories = Category::all();

        $users = User::all();
        foreach ($users as $user){
            $user->total_score = $user->getTotalScore();
        }
        $users = $users->sortByDesc('total_score');
        $users = $users->take(10);

        $userLogued = Auth::user();

        $data = DB::select('SELECT users.username, SUM(points) as points FROM participations, users WHERE users.id = participations.user_id	GROUP by user_id ORDER by SUM(participations.points) DESC');

        return view('front', [
            'categories' => $categories,
            'competitions' => $competitions,
            'users' => $users,
            'headlineCompetition' => $headlineCompetition,
            'lastWeekCompetition' => $lastWeekCompetition,
            'showLastWeekLeaderboard' => $showLastWeekLeaderboard,
            'userLogued' => $userLogued,
            'data' => $data,
        ]);
    }

    public function leaderboard(){
        return view('leaderboard');
    }

    public function admin(Request $request){
        if(empty(Config::where('key', 'headlineCompetition')->first()->value)){
            $headlineCompetitionId = '-';
            $lastWeekCompetitionId = '-';
        }else{
            $headlineCompetitionId = Config::where('key', 'headlineCompetition')->first()->value;
            $lastWeekCompetitionId = Config::where('key', 'lastWeekCompetition')->first()->value;
        }

        $headlineCompetition = Competition::find($headlineCompetitionId);

        $hints = DB::table('hints')
        ->join('challenges', 'hints.challenge_id', 'challenges.id')
        ->select('hints.id', 'challenges.name as name_chal', 'hints.name', 'hints.description')
        ->limit(5)
        ->get();


        return view('dashboard.admin.app', [
            'competitions' => Competition::limit(5)->orderBY('start_date', 'DESC')->orderBY('id', 'DESC')->get(),
            'challenges' => Challenge::limit(6)->get(),
            'categories' => Category::all(),
            'users' => User::all(),
            'hints' => $hints,
            'headlineCompetition' => $headlineCompetition,
        ]);
    }

    public function headLineCompetition(Request $request){
        $competition_id = $request->input('headlinecompetition');

        $config = Config::find(1);
        $config->value = $competition_id;
        $config->save();

        return back();
    }
}
