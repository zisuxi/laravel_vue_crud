<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10); // Adjust the number of items per page
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

$add_category= Category::create([
    'cat_name'=>$request->input('cat_name'),
    'cat_des'=>$request->input('cat_des'),

]);
if($add_category){
      return  response()->json(['message'=>200],200);
}
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $editCategory=Category::where('id',$id)->first();
        return  response()->json($editCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $updateCategory=Category::where('id',$request->id)->update([
     'cat_name'=>$request->input('cat_name'),
     'cat_des'=>$request->input('cat_des'),
      ]);
      if($updateCategory){
            return  response()->json(['message'=>200],200);
      }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $del_cat= category::where('id',$id)->delete();
  if($del_cat){
      return  response()->json(['message'=>200]);
  }
    }
}
