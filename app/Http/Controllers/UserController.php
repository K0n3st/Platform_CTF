<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Competition;
use App\Participation;
use DB;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $competitions = Competition::all();
        $participations = Participation::all();

        $data = DB::table('participations')
            ->join('competitions', 'participations.competition_id', 'competitions.id')
            ->join('users', 'participations.user_id', 'users.id')
            ->select('users.username', 'competitions.name', 'participations.points', 'participations.id','competitions.id')
            ->orderBy('participations.points', 'DESC')
            ->orderBy('users.username', 'DESC')
            ->get();



        return view('dashboard.admin.user.show', [
            'user' => $user,
            'competitions' => $competitions,
            'participations' => $participations,
            'data' => $data,
        ]);
    }

    public function showAllUsers(){
        $users = User::all();

        return view('users', [
            'users' => $users
        ]);
    }

    public function banned(){
        return view('banned.index');
    }
}
