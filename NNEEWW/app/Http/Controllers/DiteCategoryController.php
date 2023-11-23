<?php

namespace App\Http\Controllers;

use App\Models\DiteCategory;
use DB;
use Illuminate\Http\Request;

class DiteCategoryController extends Controller
{
    public function DiteCategoriesList()
    {
        $allDiteCategories = DiteCategory::all();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('dite_categories.list', ['allDiteCategories' => $allDiteCategories, 'status' => $status]);
    }

    public function addDiteCategory()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('dite_categories.add', compact('status'));
    }

    public function saveDiteCategory(Request $request)
    {
        $DiteCategory = DiteCategory::create($request->all());
        if ($DiteCategory->wasRecentlyCreated) {
            return redirect()->route('dite.category.list')->with(['success' => 'Diet Category  has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }
    }

    public function viewDiteCategory($id)
    {
        $data = DiteCategory::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('dite_categories.view', compact('status', 'data'));
    }

    public function editDiteCategory($id)
    {
        $data = DiteCategory::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('dite_categories.edit', compact('status', 'data'));
    }

    public function updateDiteCategory(Request $request)
    {
//  dd($request->all());

        $updateDiteCat = DiteCategory::where('id', $request->dite_category_id)
            ->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);

        if ($updateDiteCat) {
            return redirect()->route('dite.category.list')->with(['success' => 'Diet Category  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function deleteDiteCategory(Request $request)
    {
        //dd($request->all());

        $DiteCategory = DiteCategory::where('id', $request->id)->first();
        if ($DiteCategory) {
            $DiteCategory->delete();
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
