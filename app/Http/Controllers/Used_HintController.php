<?php

namespace App\Http\Controllers;

use App\Competition;
use App\UsedHint;
use App\UsedHintTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class Used_HintController extends Controller
{
    public function freeHint($competition,$challenge,$hint){
        $used_hint = new UsedHint();

        $used_hint->users_id = Auth::user()->id;
        $used_hint->hints_id = $hint;
        $used_hint->competition_id = $competition;
        $used_hint->challenge_id = $challenge;

        $used_hint->save();

        return back();
    }

    public function freeHintTeam($competition,$challenge,$hint){
        $team_user = DB::table('team_user')->select('team_id')->where('user_id', Auth::user()->id)->where('competition_id', $competition)->first();

        $used_hint = new UsedHintTeam();

        $used_hint->team_id = $team_user->team_id;
        $used_hint->hints_id = $hint;
        $used_hint->competition_id = $competition;
        $used_hint->challenge_id = $challenge;

        $used_hint->save();

        return back();
    }
}
