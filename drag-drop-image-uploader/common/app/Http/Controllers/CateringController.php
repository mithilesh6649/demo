<?php

namespace App\Http\Controllers;

use App\Models\Catring;
use Auth;
use DB;
use Illuminate\Http\Request;

class CateringController extends Controller
{

    //showing catering list

    public function cateringList()
    {
        if (Auth::user()->can("view_catering")) {
            $cateringList = Catring::with('city')->get();
            $catering_order_status = DB::table('md_dropdowns')->where('slug', 'catering_order_status')->get()->toArray();
            return view('catering.list', compact('cateringList', 'catering_order_status'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function viewCatering($id)
    {
        if (Auth::user()->can("view_catering")) {
            $cateringList = Catring::with('city')->where('id', $id)->first();
            return view('catering.view', compact('cateringList'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function editCatering($id)
    {
        if (Auth::user()->can("edit_catering")) {
            //get data form md dropdown

            $catering_order_status = DB::table('md_dropdowns')->where('slug', 'catering_order_status')->get()->toArray();
            $menu_type = DB::table('md_dropdowns')->where('slug', 'menu_type')->get()->toArray();
            $celebration_type = DB::table('md_dropdowns')->where('slug', 'celebration_type')->get()->toArray();
            // dd($catering_order_status);

            $cateringList = Catring::with('city')->where('id', $id)->first();
            return view('catering.edit', compact('cateringList', 'catering_order_status', 'menu_type', 'celebration_type'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateCatering(Request $request)
    {
        // dd($request->all());
        $catering = Catring::where('id', $request->cate_id)->first();
        $catering->menu_type = $request->menu_type;
        $catering->first_name = $request->first_name;
        $catering->last_name = $request->last_name;
        $catering->celebration_type = $request->celebration_type;
        $catering->date_of_celebrations = $request->date_of_celebrations;
        $catering->complete_address = $request->complete_address;
        $catering->status = $request->status;

        if ($catering->update()) {
            return redirect()->route('catering.list')->with(['success' => 'Catering has been Updated successfully !']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function deleteCatering(Request $request)
    {

        $catering = Catring::where('id', $request->id)->delete();
        return response()->json(['success' => 1]);
    }

}
