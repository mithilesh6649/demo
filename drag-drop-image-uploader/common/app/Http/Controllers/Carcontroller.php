<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Driver;
use App\Models\Ownership;
use App\Models\BranchCar;
use Auth;
use Illuminate\Http\Request;

class Carcontroller extends Controller
{

    function list() {
        if (Auth::user()->can("cars_management")) {

            $list = Cars::with('owner:id,ownership_name', 'driver:id,drivers_name', 'carBranch:car_id,branch_id', 'carBranch.Branch')->orderBy('expiry_date', 'ASC')->get();
            return view('misc.cars.list', compact('list'));
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
        if (Auth::user()->can("add_car")) {

            $owner = Ownership::where('status', '1')->get();
            $driver = Driver::where('status', '1')->get();

            return view('misc.cars.add', compact('owner', 'driver'));
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

        if ($request->expiry_date != '') {
            $date = str_replace("/", "-", $request->expiry_date);
            $expiry_date = date('Y-m-d', strtotime($date));
        } else {
            $expiry_date = null;
        }

        $car = new Cars();
        $car->lease_no = $request->lease;
        $car->expiry_date = $expiry_date;
        $car->no_plate = $request->no_plate;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->file_no = $request->file_no;
        $car->document_no = $request->document_no;
        $car->chassis_no = $request->chassis_no;
        $car->owner_id = $request->ownership_id;
        $car->driver_id = $request->driver_id;
        $car->branch = $request->branch;
        $car->ins_no = $request->ins_no;
        $car->remarks = $request->remarks;
        $car->status = 1;

        $car->save();

        return redirect()->route('cars.list')->with(['status' => 'Cars details add successfully']);

    }

    public function views($id)
    {
        if (Auth::user()->can("view_car")) {

            $owner = Ownership::where('status', '1')->get();
            $drivers = Driver::where('status', '1')->get();

            $driver = Cars::where('id', $id)->first();
            $driver = Cars::where('id', $id)->first();
            return view('misc.cars.view', compact('driver', 'owner', 'drivers'));

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
        if (Auth::user()->can("edit_car")) {

            $owner = Ownership::where('status', '1')->get();
            $drivers = Driver::where('status', '1')->get();

            $driver = Cars::where('id', $id)->first();
            return view('misc.cars.edit', compact('driver', 'owner', 'drivers'));
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

        $date = str_replace("/", "-", $request->expiry_date);
        $expiry_date = date('Y-m-d', strtotime($date));

        $car = Cars::where('id', $request->id)->first();
        $car->lease_no = $request->lease;
        $car->expiry_date = $expiry_date;
        $car->no_plate = $request->no_plate;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->file_no = $request->file_no;
        $car->document_no = $request->document_no;
        $car->chassis_no = $request->chassis_no;
        $car->owner_id = $request->ownership_id;
        $car->driver_id = $request->driver_id;
        $car->branch = $request->branch;
        $car->ins_no = $request->ins_no;
        $car->remarks = $request->remarks;
        $car->status = $request->status;

        $car->update();

        return redirect()->route('cars.list')->with(['status' => 'Cars details update successfully']);
    }

    public function deletes(Request $request)
    {

       $car = Cars::where('id', $request->id)->each(function($car){

        // first child

      BranchCar::where('car_id',$car->id)->each(function($branch_car){
        $branch_car->delete();
        });

      //Parent Delete
     $car->delete();

      
        });
       // $car = Cars::where('id', $request->id)->first();
        if ($car) {
            //$car->delete();
            return response()->json(['success' => 1]);

        } else {
            return response()->json(['success' => 0]);

        }
    }

    //deletedOfferList
    public function deletedCarsList()
    { 
        if (Auth::user()->can("manage_recyle_cars_tab")) {

            $allCars = Cars::onlyTrashed()->get();

            return view('misc.cars.deleted_list', compact("allCars"));
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
    public function restoreCars(Request $request)
    {

        $car = Cars::where('id', $request->id)->withTrashed()->each(function($car){

        // first child

      BranchCar::where('car_id',$car->id)->withTrashed()->each(function($branch_car){
        $branch_car->restore();
        });

      //Parent restore
     $car->restore();

      
        });


        // Cars::withTrashed()
        //     ->find($request->id)
        //     ->restore();
        return "success";
    }

    //Permanent Delete Offer
    public function permanentDeleteCars(Request $request)
    {

          $car = Cars::where('id', $request->id)->onlyTrashed()->each(function($car){

        // first child

      BranchCar::where('car_id',$car->id)->onlyTrashed()->each(function($branch_car){
        $branch_car->forceDelete();
        });

      //Parent forceDelete
     $car->forceDelete();

      
        });


        // Cars::onlyTrashed()
        //     ->find($request->id)
        //     ->forceDelete();
        return "success";
    }

}
