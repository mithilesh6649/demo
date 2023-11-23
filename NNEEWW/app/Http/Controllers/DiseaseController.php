<?php

namespace App\Http\Controllers;

use App\Models\HealthComplaint;
use DB;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function diseasesList()
    {
        // Test::WIDTH;
        $AllDisease = HealthComplaint::where('type',HealthComplaint::DISEASE)->get();
        return view('disease.list', ['AllDisease' => $AllDisease]);
    }

    public function addDiseases()
    {
        $genetic_test_type = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('disease.add', compact('genetic_test_type', 'status'));
    }

    public function saveDiseases(Request $request)
    {
        //  return env('APP_URL');
        //dd($request->all());
        $Disease = new HealthComplaint();
        $Disease->name = $request->name;
        $Disease->status = $request->status;
        $Disease->type = HealthComplaint::DISEASE;
        $Disease->description = $request->description;

        if ($Disease->save()) {

            return redirect()->route('diseases_list')->with(['success' => 'Disease  has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function viewDiseases($id)
    {
        $data = HealthComplaint::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('disease.view', compact('status', 'data'));
    }

    public function editDiseases($id)
    {
        $data = HealthComplaint::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('disease.edit', compact('status', 'data'));
    }

    public function updateDiseases(Request $request)
    {
        //dd($request->all());

        $Disease = HealthComplaint::where('id', $request->disease_id)->first();
        $Disease->name = $request->name;
        $Disease->status = $request->status;
        $Disease->description = $request->description;

        if ($Disease->update()) {

            return redirect()->route('diseases_list')->with(['success' => 'Disease  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function deleteDiseases(Request $request)
    {

        $Disease = HealthComplaint::where('id', $request->id)->first();
        if ($Disease) {
            $Disease->delete();
            return response()->json([
                'success' => 1,
            ]);
        } else {
            return response()->json([
                'success' => 0,
            ]);
        }
    }


    public function allergyList()
    {
        // Test::WIDTH;
         $AllDisease = HealthComplaint::where('type',HealthComplaint::ALLERGY)->get();
        return view('allergy.list', ['AllDisease' => $AllDisease]);
    } 



    public function addAllergy()
    {
        $genetic_test_type = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('allergy.add', compact('genetic_test_type', 'status'));
    }

    public function saveAllergy(Request $request)
    {
        //  return env('APP_URL');
        //dd($request->all());
        $Disease = new HealthComplaint();
        $Disease->name = $request->name;
        $Disease->status = $request->status;
        $Disease->type = HealthComplaint::ALLERGY;
        $Disease->description = $request->description;

        if ($Disease->save()) {

            return redirect()->route('allergy_list')->with(['success' => 'Allergy  has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function viewAllergy($id)
    {
        $data = HealthComplaint::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('allergy.view', compact('status', 'data'));
    }

    public function editAllergy($id)
    {
        $data = HealthComplaint::where('id', $id)->first();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('allergy.edit', compact('status', 'data'));
    }

    public function updateAllergy(Request $request)
    {
        //dd($request->all());

        $Disease = HealthComplaint::where('id', $request->disease_id)->first();
        $Disease->name = $request->name;
        $Disease->status = $request->status;
        $Disease->description = $request->description;

        if ($Disease->update()) {

            return redirect()->route('allergy_list')->with(['success' => 'Allergy   has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }


}
