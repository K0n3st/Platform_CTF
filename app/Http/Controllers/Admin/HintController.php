<?php

namespace App\Http\Controllers\Admin;

use App\Challenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Hint;
use DB;



class HintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hints = DB::table('hints')
        ->join('challenges', 'hints.challenge_id', 'challenges.id')
        ->select('hints.id', 'challenges.name as name_chal', 'hints.name', 'hints.description')
        ->get();
        return view('dashboard.admin.hint.index',[ 'hints' => $hints ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.hint.create', [
            'hints' => Hint::all(),
            'challenges' => Challenge::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $hint = new Hint;
        $hint->name = $request->input('name');
        $hint->description = $request->input('description');
        $hint->challenge_id = $request->input('challenge_id');

        $hint->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('hint', ['hint' => Hint::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.admin.hint.edit', [
            'hint' => Hint::find($id),
            'challenges' => Challenge::all()
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hint = Hint::find($id);
        $hint->name = $request->input('name');
        $hint->description = $request->input('description');
        $hint->challenge_id = $request->input('challenge_id');

        $hint->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('hints')->where('id', $id)->delete();

        return back();
    }
}
