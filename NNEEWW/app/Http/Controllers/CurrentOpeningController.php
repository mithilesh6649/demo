<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrentOpening;
use DB;
class CurrentOpeningController extends Controller
{
   public function CurrentOpeningList(){
       $allCurrentOpening =  CurrentOpening::all();
       return view("current_opeings.list", compact("allCurrentOpening"));
   }

   public function addCurrentOpening(){
      //return "working";
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view("current_opeings.add",compact('status'));
}


public function saveCurrentOpening(Request $request){
    //dd($request->all());
 $saveData = CurrentOpening::create($request->all());
 if ($saveData->wasRecentlyCreated == true) {

    return redirect()->route('current_opening_list')->with(['success' => 'Job  has been created successfully!']);
} else {
    return redirect()->back()->with('warning', 'Something went wrong!');
}
}


public function editCurrentOpening($id){
    $data =  CurrentOpening::where('id',$id)->first();   
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view("current_opeings.edit",compact('status','data'));

}


public function updateCurrentOpening(Request $request){
    //dd($request->all());
    CurrentOpening::where('id', $request->job_id)
    ->update([
     'job_title' => $request->job_title,
     'department' => $request->department,
     'location' => $request->location,
     'employee_type' => $request->employee_type,
     'description' => $request->description,
     'status' => $request->status,
 ]);

  return redirect()->route('current_opening_list')->with(['success' => 'Job  has been updated successfully!']);
  

}
 

 public function viewCurrentOpening($id){
    $data =  CurrentOpening::where('id',$id)->first();   
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view("current_opeings.view",compact('status','data'));

}


public function deleteCurrentOpening(Request $request){
            $Blog = CurrentOpening::where('id', $request->id)->first();
        if ($Blog) {
            $Blog->delete();
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
