<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use DB;
class ExerciseController extends Controller
{
 public function exerciseList(){
     $allExercises =  Exercise::all();
     return view("exercises.list", compact("allExercises"));
 }

 public function addExercise(){
     $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
     return view("exercises.add",compact('status'));
 }

 public function saveExercise(Request $request){
    $saveData = Exercise::create($request->all());
    if ($saveData->wasRecentlyCreated == true) {

        return redirect()->route('exercise_list')->with(['success' => 'Exercise  has been created successfully!']);
    } else {
        return redirect()->back()->with('warning', 'Something went wrong!');
    }
}



public function editExercise($id){
    $data =  Exercise::where('id',$id)->first();   
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view("exercises.edit",compact('status','data'));

}

public function updateExercise(Request $request){
  

      Exercise::where('id', $request->exercise_id)
    ->update([
     'title' => $request->title,
     'calories_burnt' => $request->calories_burnt,
     'duration_in_minutes' => $request->duration_in_minutes,
     'status' => $request->status,
 ]);

     return redirect()->route('exercise_list')->with(['success' => 'Exercise  has been updated successfully!']);
}


public function viewExercise($id){
       $data =  Exercise::where('id',$id)->first();   
    $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
    return view("exercises.view",compact('status','data'));
}



public function deleteExercise(Request $request){
            $Exercise = Exercise::where('id', $request->id)->first();
        if ($Exercise) {
            $Exercise->delete();
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
