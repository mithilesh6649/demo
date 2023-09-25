<?php

namespace App\Http\Controllers;

 
use App\Models\Cars;
use App\Models\Driver;
use App\Models\BranchDriver;
use Auth;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    function list() {
        if (Auth::user()->can("drivers_management")) {

            $list = Driver::orderBy('created_at', 'DESC')->get();
            return view('misc.drivers.list', compact('list'));
        } else {
            return redirect()
            ->route("dashboard")
            ->with(
                "warning",
                "You do not have permission for this action!"
            );
        }
    }

    public function add()
    {
        if (Auth::user()->can("add_driver")) {
            return view('misc.drivers.add');
        } else {
            return redirect()
            ->route("dashboard")
            ->with(
                "warning",
                "You do not have permission for this action!"
            );
        }

    }

    public function saves(Request $request)
    {

        $owner = new Driver();
        $owner->drivers_name = $request->driver;
        $owner->status = 1;
        $owner->save();

        return redirect()->route('drivers.list')->with(['status' => 'Driver Name add successfully']);

    }

    public function views($id)
    {
        if (Auth::user()->can("view_driver")) {

            $driver = Driver::where('id', $id)->first();
            return view('misc.drivers.view', compact('driver'));
        } else {
            return redirect()
            ->route("dashboard")
            ->with(
                "warning",
                "You do not have permission for this action!"
            );
        }

    }

    public function edit($id)
    {
        if (Auth::user()->can("edit_driver")) {
            $driver = Driver::where('id', $id)->first();
            return view('misc.drivers.edit', compact('driver'));
        } else {
            return redirect()
            ->route("dashboard")
            ->with(
                "warning",
                "You do not have permission for this action!"
            );
        }

    }

    public function updates(Request $request)
    {
        $owner = Driver::where('id', $request->id)->first();
        $owner->drivers_name = $request->driver;
        $owner->status = $request->status;
        $owner->update();

        return redirect()->route('drivers.list')->with(['status' => 'Driver details update successfully']);
    }

    public function deletes(Request $request)
    {

        $driver = Driver::where('id', $request->id)->each(function($driver){

        // first child
            BranchDriver::where('driver_id',$driver->id)->each(function($branch_driver){
                $branch_driver->delete();
            });

        //Parent Delete
            $driver->delete();

        });
       // $driver = Driver::where('id', $request->id)->first();
        if ($driver) {
           // $driver->delete();
            return response()->json(['success' => 1]);

        } else {
            return response()->json(['success' => 0]);

        }
    }

    //deletedOfferList
    public function deletedDriversList()
    {
        if (Auth::user()->can("manage_recyle_drivers_tab")) {

            $allDrivers = Driver::onlyTrashed()->get();

            return view('misc.drivers.deleted_list', compact("allDrivers"));
        } else {
            return redirect()
            ->route("dashboard")
            ->with(
                "warning",
                "You do not have permission for this action!"
            );
        }
    }

    //Restore Offer
    public function restoreDrivers(Request $request)
    {
        // Driver::withTrashed()
        // ->find($request->id)
        // ->restore();

        $driver = Driver::where('id', $request->id)->withTrashed()->each(function($driver){

        // first child
            BranchDriver::where('driver_id',$driver->id)->withTrashed()->each(function($branch_driver){
                $branch_driver->restore();
            });

        //Parent restore
            $driver->restore();

        });

        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteDrivers(Request $request)
    {
           
                // // First Check in Car //

        // $car = Cars::where('driver_id', $request->id)->first();

        // // ------------- //

        // // Check in Car Branch for that Car //

        // if ($car) {
        //     Cars::where('driver_id', $request->id)->update(['driver_id' => null]);
        // }

             $driver = Driver::where('id', $request->id)->onlyTrashed()->each(function($driver){

        // first child
            BranchDriver::where('driver_id',$driver->id)->onlyTrashed()->each(function($branch_driver){
                $branch_driver->forceDelete();
            });

        //Parent forceDelete
            $driver->forceDelete();

        });  
        // // First Check in Car //

        // $car = Cars::where('driver_id', $request->id)->first();

        // // ------------- //

        // // Check in Car Branch for that Car //

        // if ($car) {
        //     Cars::where('driver_id', $request->id)->update(['driver_id' => null]);
        // }

        // // ---------------- //

        // // Check Driver in Branch Driver //

        // $branch_driver = BranchDriver::where('driver_id', $request->id)->first();

        // if ($branch_driver) {
        //     BranchDriver::where('driver_id', $request->id)->forceDelete();
        // }

        // //  ---------------- //

        // // Delte Driver //

        // Driver::onlyTrashed()
        // ->find($request->id)
        // ->forceDelete();
        return "success";

        // ---------- //

    }

}
