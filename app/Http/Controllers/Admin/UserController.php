<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function bannedUser(Request $request){
        $user_id = $request->input('user_id');
        $user = User::find($user_id);

        $user->banned = 1;
        $user->save();

        return back();
    }

    public function unBannedUser(Request $request){
        $user_id = $request->input('user_id');
        $user = User::find($user_id);

        $user->banned = 0;
        $user->save();

        return back();
    }
}
