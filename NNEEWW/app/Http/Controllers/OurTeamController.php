<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\OurTeam;

class OurTeamController extends Controller
{
     public function OurTeamList(){
            $AllSpecialization = OurTeam::all();
          $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('our_teams.list', ['AllSpecializations' => $AllSpecialization, 'status' => $status]);
     }

     public function addOurTeam(){
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('our_teams.add', ['status' => $status]);        
     }


          public function saveOurTeam(Request $request){
          //dd($request->all());
        $Specialization = new OurTeam();
        $Specialization->name = $request->name;
        $Specialization->description = $request->description; 
        $Specialization->status = $request->status;
         $Specialization->experience = $request->experience;
         if ($request->has('is_ceo')) {
                $Specialization->is_ceo = 1;
            } else {
                $Specialization->is_ceo = 0;
            }


        if ($request->file("thumbnail")) {
            $SpecializationImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $SpecializationImage->getClientOriginalExtension();
            $SpecializationImage->move("images/media", $thumbnail);
            $Specialization->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
        }

        if ($Specialization->save()) {

            return redirect()->route('our_team_list')->with(['success' => 'Team has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }
            
    }
      


    public function editOurTeam($id){
        $data = OurTeam::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('our_teams.edit', compact('status', 'data'));
    }

    public function updateOurTeam(Request $request)
    {
        //dd($request->all());

        $Specialization = OurTeam::where('id', $request->specialization_id)->first();
        $Specialization->name = $request->name;
        $Specialization->status = $request->status;
        $Specialization->description = $request->description; 
        $Specialization->experience = $request->experience;
         if ($request->has('is_ceo')) {
                $Specialization->is_ceo = 1;
            } else {
                $Specialization->is_ceo = 0;
            }

        if ($request->file("thumbnail")) {
            $SpecializationImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $SpecializationImage->getClientOriginalExtension();
            $SpecializationImage->move("images/media", $thumbnail);
            $Specialization->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
        }

        if ($Specialization->update()) {

            return redirect()->route('our_team_list')->with(['success' => 'Team  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }  


    public function viewOurTeam($id){
        $data = OurTeam::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('our_teams.view', compact('status', 'data'));
    }

    public function deleteOurTeam(Request $request)
    {

        $Specialization = OurTeam::where('id', $request->id)->first();
        if ($Specialization) {
            $Specialization->delete();
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
