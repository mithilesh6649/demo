<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\NutritionistSpecializationMap;

class SpecializationController extends Controller
{
    public function SpecializationList()
    {
        $AllSpecialization = Specialization::all();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('specializations.list', ['AllSpecializations' => $AllSpecialization, 'status' => $status]);
    }

    public function addSpecialization()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('specializations.add', ['status' => $status]);
    }
    
    public function saveSpecialization(Request $request){
         // dd($request->all());
        $Specialization = new Specialization();
        $Specialization->name = $request->name;
        $Specialization->status = $request->status;
        if ($request->file("thumbnail")) {
            $SpecializationImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $SpecializationImage->getClientOriginalExtension();
            $SpecializationImage->move("images/specialization", $thumbnail);
            $Specialization->image = env('IMAGE_BASE_URL') . '/images/specialization/' . $thumbnail;
        }

        if ($Specialization->save()) {

            return redirect()->route('specialization_list')->with(['success' => 'Specialization  has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function editSpecialization($id){
        $data = Specialization::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('specializations.edit', compact('status', 'data'));
    }

    public function updateSpecialization(Request $request)
    {
        //dd($request->all());

        $Specialization = Specialization::where('id', $request->specialization_id)->first();
        $Specialization->name = $request->name;
        $Specialization->status = $request->status;

        if ($request->file("thumbnail")) {
            $SpecializationImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $SpecializationImage->getClientOriginalExtension();
            $SpecializationImage->move("images/specialization", $thumbnail);
            $Specialization->image = env('IMAGE_BASE_URL') . '/images/specialization/' . $thumbnail;
        }

        if ($Specialization->update()) {

            return redirect()->route('specialization_list')->with(['success' => 'Specialization  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }


    public function viewSpecialization($id){
        $data = Specialization::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('specializations.view', compact('status', 'data'));
    }

    public function deleteSpecialization(Request $request)
    { 

        // $Specialization = Specialization::where('id', $request->id)->first();


        // if ($Specialization) {
        //     $Specialization->delete();
        //     return response()->json([
        //         'success' => 1,
        //     ]);
        // } else {
        //     return response()->json([
        //         'success' => 0,
        //     ]);
        // } 



        $specialization = Specialization::where('id', $request->id)->first();
        $specialization_trashed = NutritionistSpecializationMap::where('specialization_id', $request->id)->count();

        if($specialization_trashed > 0) {
            $res['success'] = 0;
            $res['message'] = "You cannot delete this record as it's being used.";
            return json_encode($res);
        }
        else {
         $specialization = Specialization::where('id', $request->id)->first();
         
            // $role->admins()->delete();
         $deleteSpecialization = $specialization->delete();
         if($deleteSpecialization) {
            $res['success'] = 1;
            return json_encode($res);
        }
        else {
            $res['success'] = 0;
            $res['message'] = "Something went wrong! Please try again.";
            return json_encode($res);
        }
    }

}

}
