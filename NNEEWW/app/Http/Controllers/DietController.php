<?php

namespace App\Http\Controllers;

use App\Models\Dite;
use App\Models\DiteCategory;
use DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class DietController extends Controller
{
    public function DietsList()
    {
        $dites = Dite::with('DiteCategory')->where('type',Dite::DIET)->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('diets.list', ['dites' => $dites, 'status' => $status]);
    }

    public function addDiet()
    {
        $All_Active_Diets = DiteCategory::ACTIVE_DIET_CATEGORY();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('diets.add', ['All_Active_Diets' => $All_Active_Diets, 'status' => $status]);
    }

    public function saveDiet(Request $request)
    {

        $recipe_obj = new Dite();
        $recipe_obj->diet_category_id = $request->diet_category_id;
        $recipe_obj->title = $request->title;
        $recipe_obj->description = $request->description;
        $recipe_obj->amount = $request->amount;
        $recipe_obj->status = $request->status;

        if ($request->file("thumbnail")) {
            $RecipeImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $RecipeImage->getClientOriginalExtension();
            $RecipeImage->move("images/diets", $thumbnail);
            $recipe_obj->image = env('IMAGE_BASE_URL') . '/images/diets/' . $thumbnail;
        }

        if ($recipe_obj->save()) {

            return redirect()->route('diet.list')->with(['success' => 'Diet  has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function editDiet($id)
    {
        $data = Dite::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $All_Active_Diets = DiteCategory::ACTIVE_DIET_CATEGORY();
        return view('diets.edit', compact('status', 'data', 'All_Active_Diets'));
    }

    public function updateDiet(Request $request)
    {

        $Diets = Dite::where('id', $request->diet_id)->first();
        $Diets->diet_category_id = $request->diet_category_id;
        $Diets->title = $request->title;
        $Diets->description = $request->description;
        $Diets->amount = $request->amount;
        $Diets->status = $request->status;
        if ($request->file("thumbnail")) {
            $DietsImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $DietsImage->getClientOriginalExtension();
            $DietsImage->move("images/diets", $thumbnail);
            $Diets->image = env('IMAGE_BASE_URL') . '/images/diets/' . $thumbnail;
        }

        if ($Diets->update()) {

            return redirect()->route('diet.list')->with(['success' => 'Diet  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function viewDiet($id)
    {
        $data = Dite::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        $All_Active_Diets = DiteCategory::ACTIVE_DIET_CATEGORY();
        return view('diets.view', compact('status', 'data', 'All_Active_Diets'));

    } 

    public function deleteDiet(Request $request ){

        $Dite = Dite::where('id', $request->id)->first();
        if ($Dite) {
            $Dite->delete();
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
