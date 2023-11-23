<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\RecipeCategory;

class RecipeCategoryController extends Controller
{
    public function RecipeCategoriesList(){

       $RecipeCategory = RecipeCategory::all();
       $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
       return view('recipe_categories.list', ['RecipeCategories' => $RecipeCategory, 'status' => $status]);
   }

   public function addRecipeCategory(){
    
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('recipe_categories.add', ['status' => $status]); 
}


public function saveRecipeCategory(Request $request){

    $RecipeCategory = new RecipeCategory();
    $RecipeCategory->title = $request->title;
    $RecipeCategory->status = $request->status;
    if ($request->file("thumbnail")) {
        $RecipeCategoryImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $RecipeCategoryImage->getClientOriginalExtension();
        $RecipeCategoryImage->move("images/RecipeCategory", $thumbnail);
        $RecipeCategory->image = env('IMAGE_BASE_URL') . '/images/RecipeCategory/' . $thumbnail;
    }

    if ($RecipeCategory->save()) {

        return redirect()->route('recipe.category.list')->with(['success' => 'Recipe Category  has been created successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }

}

public function editRecipeCategory($id){
    $data = RecipeCategory::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('recipe_categories.edit', compact('status', 'data'));
}

public function updateRecipeCategory(Request $request)
{
        //dd($request->all());

    $RecipeCategory = RecipeCategory::where('id', $request->recipe_category_id)->first();
    $RecipeCategory->title = $request->title;
    $RecipeCategory->status = $request->status;

    if ($request->file("thumbnail")) {
        $RecipeCategoryImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $RecipeCategoryImage->getClientOriginalExtension();
        $RecipeCategoryImage->move("images/RecipeCategory", $thumbnail);
        $RecipeCategory->image = env('IMAGE_BASE_URL') . '/images/RecipeCategory/' . $thumbnail;
    }

    if ($RecipeCategory->update()) {

        return redirect()->route('recipe.category.list')->with(['success' => 'Recipe Category  has been updated successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }

}


public function viewRecipeCategory($id){
    $data = RecipeCategory::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view('recipe_categories.view', compact('status', 'data'));
}

public function deleteRecipeCategory(Request $request)
{

    $RecipeCategory = RecipeCategory::where('id', $request->id)->first();
    if ($RecipeCategory) {
        $RecipeCategory->delete();
        return response()->json([
            'success' => 1,
        ]);
    } else {
        return response()->json([
            'success' => 0,
        ]);
    }
}
}
