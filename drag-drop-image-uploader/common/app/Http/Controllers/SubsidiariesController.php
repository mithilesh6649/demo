<?php

namespace App\Http\Controllers;

use App\Models\Subsidiaries;
use Auth;
use DB;
use Illuminate\Http\Request;

class SubsidiariesController extends Controller
{
    public function SubsidiariesList()
    {
        if (Auth::user()->can("subsidiaries_management")) {
            $allSubsidiaries = Subsidiaries::all();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view('misc.subsidiaries.list', compact('allSubsidiaries', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function addSubsidiaries()
    {
        if (Auth::user()->can("add_subsidiaries")) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view('misc.subsidiaries.add', compact('status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function saveSubsidiaries(Request $request)
    {
        //dd($request->all());
        $subsidiaries = new Subsidiaries();
        $subsidiaries->title_en = $request->title_en;
        $subsidiaries->title_ar = $request->title_ar;
        $subsidiaries->description_en = $request->description_en;
        $subsidiaries->description_ar = $request->description_ar;
        $subsidiaries->status = $request->status;
        $subsidiaries->save();
        return redirect()->route("subsidiaries.list")->with("success", "Subsidiaries has been added successfully!");
    }

    public function viewSubsidiaries($id)
    {
        if (Auth::user()->can("view_subsidiaries")) {
            $Subsidiaries = Subsidiaries::where('id', $id)->first();

            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();

            return view('misc.subsidiaries.view', compact('Subsidiaries', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editSubsidiaries($id)
    {
        if (Auth::user()->can("edit_subsidiaries")) {
            $Subsidiaries = Subsidiaries::where('id', $id)->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            return view('misc.subsidiaries.edit', compact('Subsidiaries', 'status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateSubsidiaries(Request $request)
    {

        $subsidiaries = Subsidiaries::where('id', $request->subsidiaries_id)->first();
        $subsidiaries->title_en = $request->title_en;
        $subsidiaries->title_ar = $request->title_ar;
        $subsidiaries->description_en = $request->description_en;
        $subsidiaries->description_ar = $request->description_ar;
        $subsidiaries->status = $request->status;
        $subsidiaries->update();
        return redirect()->route("subsidiaries.list")->with("success", "Subsidiaries has been updated successfully!");

    }

    public function deleteSubsidiaries(Request $request)
    {

        $brand = Subsidiaries::where('id', $request->id);

        $brand = $brand->delete();

        if ($brand) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }
}
