<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Challenge;
use App\Category;
use DB;

class ChallengeController extends Controller
{
    /* Show all challenge */
    public function index(){
        return view('dashboard.admin.challenge.index',[ 'challenges' => Challenge::all() ]);
    }

    /* Show the form to create a challenge */
    public function create(){
        return view('dashboard.admin.challenge.create', [
                'categories' => Category::all()
            ]);
    }

    /* Show the challenge selected */
    public function show($id){
        return view('challenge', ['challenge' => Challenge::find($id)]);
    }

    /* Edit the challenge selected */
    public function edit($id)
    {
        return view('dashboard.admin.challenge.edit', [
                'challenge' => Challenge::find($id),
                'categories' => Category::all()
        ]);
    }

    /* Update the challenge selected */
    public function update(Request $request,$id){
        $challenge = Challenge::find($id);
        $challenge->name = $request->input('name');
        $challenge->description = $request->input('description');
        $challenge->flag = $request->input('flag');
        $challenge->points = $request->input('points');
        $challenge->author = $request->input('author');
        $challenge->category_id = $request->input('category');
        $challenge->visible = $request->input('visible');

        $challenge->save();

        return back();
    }

    /* Store a new category */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'author' => 'required|max:50',
            'flag' => 'required|max:255',
        ]);

        $challenge = new Challenge;
        $challenge->name = $request->input('name');
        $challenge->description = $request->input('description');
        $challenge->category_id = $request->input('category');
        $challenge->author = $request->input('author');
        $challenge->flag = $request->input('flag');
        $challenge->points = $request->input('points');

        $challenge->save();

        return back();
    }

    public function destroy($id)
    {
        DB::table('challenge_competition')->where('challenge_id', $id)->delete();

        DB::table('challenges')->where('id', $id)->delete();

        return back();
    }
}
