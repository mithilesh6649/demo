<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeCategory;

class RecipeController extends Controller
{
     public function RecipeList(){
          $recipes= Recipe::all();
         $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('recipes.list', ['recipes' => $recipes, 'status' => $status]);
      //  return view('recipes.list');
     }

     public function addRecipe(){
        $allActiveCategory = RecipeCategory::ACTIVE_RECIPE_CATEGORY();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('recipes.add', ['status' => $status,'allActiveCategories'=>$allActiveCategory]); 
    }


    public function saveRecipe(Request $request){
          //dd($request->all());
   
         $recipe_obj = new Recipe();
         $recipe_obj->recipe_category_id = $request->recipe_category_id;
         $recipe_obj->title = $request->title;
         $recipe_obj->description = $request->description;
         $recipe_obj->time = $request->timing;
         $recipe_obj->kilocalorie = $request->kilocalorie;
         $recipe_obj->serving = $request->serving;
         $recipe_obj->status = $request->status;
         $recipe_obj->ingredients =  json_encode($request->ingredients, true);
         $recipe_obj->instructions = json_encode($request->instructions, true);
         $recipe_obj->tags = json_encode($request->tags, true);
         if ($request->file("thumbnail")) {
        $RecipeImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $RecipeImage->getClientOriginalExtension();
        $RecipeImage->move("images/Recipe", $thumbnail);
        $recipe_obj->image = env('IMAGE_BASE_URL') . '/images/Recipe/' . $thumbnail;
        }
         


       if ($recipe_obj->save()) {

           return redirect()->route('recipe.list')->with(['success' => 'Recipe  has been created successfully!']);
       } else {
           return redirect()->back()->with('warning', 'Something went wrong!');
       }
    }


    public function viewRecipe($id){
          $data = Recipe::where('id', $id)->first();
          $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
               $allActiveCategories = RecipeCategory::ACTIVE_RECIPE_CATEGORY();
          return view('recipes.view', compact('status', 'data','allActiveCategories'));
    }

    public function  editRecipe($id){
          $data = Recipe::where('id', $id)->first();
          $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
               $allActiveCategories = RecipeCategory::ACTIVE_RECIPE_CATEGORY();
          return view('recipes.edit', compact('status', 'data','allActiveCategories'));
    }

    public function updateRecipe(Request $request){
       // dd($request->all());

         $recipe_obj =  Recipe::where('id',$request->recipe_id)->first();
         $recipe_obj->recipe_category_id = $request->recipe_category_id;
         $recipe_obj->title = $request->title;
         $recipe_obj->description = $request->description;
         $recipe_obj->time = $request->timing;
         $recipe_obj->kilocalorie = $request->kilocalorie;
         $recipe_obj->serving = $request->serving;
         $recipe_obj->status = $request->status;
         $recipe_obj->ingredients =  json_encode($request->ingredients, true);
         $recipe_obj->instructions = json_encode($request->instructions, true);
         $recipe_obj->tags = json_encode($request->tags, true);
         if ($request->file("thumbnail")) {
        $RecipeImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $RecipeImage->getClientOriginalExtension();
        $RecipeImage->move("images/Recipe", $thumbnail);
        $recipe_obj->image = env('IMAGE_BASE_URL') . '/images/Recipe/' . $thumbnail;
        }
         


       if ($recipe_obj->save()) {

           return redirect()->route('recipe.list')->with(['success' => 'Recipe  has been updated successfully!']);
       } else {
           return redirect()->back()->with('warning', 'Something went wrong!');
       }
    }


    public function deleteRecipe(Request $request)
{

    $Recipe = Recipe::where('id', $request->id)->first();
    if ($Recipe) {
        $Recipe->delete();
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
