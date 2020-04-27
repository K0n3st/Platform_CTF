<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Category;
use DB;



class CategoryController extends Controller
{
    /* Show all categories */
    public function index(){
        return view('dashboard.admin.category.index',['categories' => Category::all()]);
    }

    /* Show the form to create a category */
    public function create(){
        return view('dashboard.admin.category.create');
    }

    /* Show the category selected */
    public function show($id){
        return view('category', ['category' => Category::find($id)]);
    }

    /* Store a new category */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return back();
    }

    /* Edit the category selected */
    public function edit($id){
        return view('dashboard.admin.category.edit', ['category' => Category::find($id)]);
    }

    /* Update the category selected */
    public function update(Request $request,$id){
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return back();
    }

    public function destroy($id)
    {

        DB::table('categories')->where('id', $id)->delete();

        return back();
    }
}
