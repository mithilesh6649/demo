<?php

namespace App\Http\Controllers;

use App\Models\HealthComplaint;
use DB;
use Illuminate\Http\Request;

class ProjectFeatureController extends Controller
{
   public function ProjectFeatureList(){
       $AllHealthComplaints = HealthComplaint::get();
       $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
       $health_complaints = DB::table('md_dropdowns')->where('slug', 'health_complaints')->Orwhere('slug', 'food_preferences')->get();
    //   dd($health_complaints);
       return view('health_complaints.list',compact('AllHealthComplaints','health_complaints','status'));
   }

   public function addProjectFeature()
   {
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    $health_complaints = DB::table('md_dropdowns')->where('slug', 'health_complaints')->Orwhere('slug', 'food_preferences')->get();
    return view('health_complaints.add',compact('health_complaints','status'));
}

public function saveProjectFeature(Request $request){
        //  dd($request->all());
    $HealthComplaint = new HealthComplaint();
    $HealthComplaint->name = $request->name;
    $HealthComplaint->description = $request->description;
    $HealthComplaint->types = $request->type;
    $HealthComplaint->status = $request->status;
    $HealthComplaint->is_show = isset($request->is_show) ? '1' : '0';

    if ($request->file("thumbnail")) {
        $HealthComplaintImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $HealthComplaintImage->getClientOriginalExtension();
        $HealthComplaintImage->move("images/media", $thumbnail);
        $HealthComplaint->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
    }

    if ($HealthComplaint->save()) {

        return redirect()->route('project_features_list')->with(['success' => 'Health Complaint has been created successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }

}



public function editProjectFeature($id){
    $data = HealthComplaint::where('id', $id)->first();
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    $health_complaints = DB::table('md_dropdowns')->where('slug', 'health_complaints')->Orwhere('slug', 'food_preferences')->get();
    return view('health_complaints.edit', compact('status', 'data','health_complaints'));
}

public function updateProjectFeature(Request $request)
{
      //  dd($request->all());

    $HealthComplaint = HealthComplaint::where('id', $request->health_complaint_id)->first();
    $HealthComplaint->name = $request->name;

    $HealthComplaint->description = $request->description;
    $HealthComplaint->types = $request->type;
    $HealthComplaint->status = $request->status;
    $HealthComplaint->is_show = isset($request->is_show) ? '1' : '0';

    if ($request->file("thumbnail")) {
        $HealthComplaintImage = $request->file("thumbnail");
        $thumbnail = time() . "." . $HealthComplaintImage->getClientOriginalExtension();
        $HealthComplaintImage->move("images/media", $thumbnail);
        $HealthComplaint->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
    }

    if ($HealthComplaint->update()) {

        return redirect()->route('project_features_list')->with(['success' => 'Health Complaint  has been updated successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }

}


public function viewProjectFeature($id){
 $data = HealthComplaint::where('id', $id)->first();
 $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
 $health_complaints = DB::table('md_dropdowns')->where('slug', 'health_complaints')->Orwhere('slug', 'food_preferences')->get();
 return view('health_complaints.view', compact('status', 'data','health_complaints'));
}

public function deleteProjectFeature(Request $request)
{

    $HealthComplaint = HealthComplaint::where('id', $request->id)->first();
    if ($HealthComplaint) {
        $HealthComplaint->delete();
        return response()->json([
            'success' => 1,
        ]);
    } else {
        return response()->json([
            'success' => 0,
        ]);
    }
}


 

 // For Food Preferences

 public function FoodPreferencesList(){
       $AllHealthComplaints = HealthComplaint::all();
       $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
       $health_complaints = DB::table('md_dropdowns')->where('slug', 'health_complaints')->get();
       return view('health_complaints.list',compact('AllHealthComplaints','health_complaints','status'));
   }








}
