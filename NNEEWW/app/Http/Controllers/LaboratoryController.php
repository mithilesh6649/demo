<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\LaboratoryMetadata;
use App\Models\LaboratoryTest;
use App\Models\Status;
use App\Models\Test;
use Auth;
use DB;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function LaboratoryList()
    {
        if (Auth::user()->can('laboratories_management')) {
            $allLaboratories = Laboratory::with('LaboratoryMetadata', 'labVerificationStatus')->orderBy('created_at', 'DESC')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            return view('laboratory.list', compact('allLaboratories', 'status'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }

    public function addLaboratory()
    {
        if (Auth::user()->can('add_laboratories')) {
            $allLaboratories = Laboratory::all();
            $AllActiveGeneticTest = Test::where('status', 1)->get();
            $genetic_test_types = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            return view('laboratory.add', compact('allLaboratories', 'status', 'AllActiveGeneticTest', 'genetic_test_types'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function saveLaboratory(Request $request)
    {
        // dd($request->all());

        $Laboratory = new Laboratory();
        $Laboratory->first_name = $request->first_name;
        $Laboratory->last_name = $request->last_name;
        $Laboratory->description = $request->descripiton;
        $Laboratory->status = $request->status;
        $Laboratory->lab_status = Status::where(['module_name' => 'Document', 'slug' => 'document_approved'])->value('id');
        if ($Laboratory->save()) {

            //Add Lab Tests

            if ($request->tests_id != "") {
                foreach ($request->tests_id as $key => $id) {
                    $LaboratoryTest = new LaboratoryTest();
                    $LaboratoryTest->laboratory_id = $Laboratory->id;
                    $LaboratoryTest->test_id = $id;
                    $LaboratoryTest->save();
                }
            }

            //Add Lab Meta data
            $LaboratoryMetadata = new LaboratoryMetadata();
            $LaboratoryMetadata->laboratory_id = $Laboratory->id;

            if ($request->file("thumbnail")) {
                $LabImage = $request->file("thumbnail");
                $thumbnail = time() . "." . $LabImage->getClientOriginalExtension();
                $fullUrl = $LabImage->move("images/laboratory", $thumbnail);
                $LaboratoryMetadata->image = env('IMAGE_BASE_URL') . '/' . $fullUrl;
            }

            $LaboratoryMetadata->open_time = $request->opening_time;
            $LaboratoryMetadata->close_time = $request->ending_time;
            $LaboratoryMetadata->country_code = $request->country_code;
            $LaboratoryMetadata->phone_number = $request->phone_number;
            $LaboratoryMetadata->email = $request->email;

            if ($request->has('is_partner')) {
                $LaboratoryMetadata->is_partner = 1;
            } else {
                $LaboratoryMetadata->is_partner = 0;
            }

            $LaboratoryMetadata->charges = $request->charges;
            //    $LaboratoryMetadata->discount = $request->discount;
            if ($request->has('discount')) {
                $LaboratoryMetadata->discount = $request->discount;
            }

            $LaboratoryMetadata->address = $request->address;
            $LaboratoryMetadata->city = $request->txtCity;
            $LaboratoryMetadata->state = $request->state;
            $LaboratoryMetadata->country = $request->country;
            $LaboratoryMetadata->latitude = $request->lat;
            $LaboratoryMetadata->longitude = $request->lng;
            $LaboratoryMetadata->status = $request->status;

            if ($LaboratoryMetadata->save()) {
                return redirect()
                    ->route("laboratories_list")
                    ->with("success", "laboratory has been added successfully!");
            }

        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }

    }

    public function editLaboratory($id)
    {
        if (Auth::user()->can('edit_laboratories')) {
            $LaboratoryData = Laboratory::with('LaboratoryMetadata')->where('id', $id)->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            $AllActiveGeneticTest = Test::where('status', 1)->get();
            $LaboratoryTests = LaboratoryTest::where('laboratory_id', $id)->get();
            $genetic_test_types = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
            return view('laboratory.edit', compact('LaboratoryData', 'status', 'AllActiveGeneticTest', 'genetic_test_types', 'LaboratoryTests'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }

    public function updateLaboratory(Request $request)
    {
        // dd($request->all());
        // DB::beginTransaction();
        // try
        // {
        //dd($request->all());

        $EditLaboratory = Laboratory::where('id', $request->lab_id)->first();
        $EditLaboratory->first_name = $request->first_name;
        $EditLaboratory->last_name = $request->last_name;
        $EditLaboratory->description = $request->descripiton;
        $EditLaboratory->status = $request->status;
        if ($EditLaboratory->update()) {

            //Update Lab Tests.....
            LaboratoryTest::where('laboratory_id', $request->lab_id)->delete();
            if ($request->tests_id != "") {
                foreach ($request->tests_id as $key => $id) {
                    $LaboratoryTest = new LaboratoryTest();
                    $LaboratoryTest->laboratory_id = $request->lab_id;
                    $LaboratoryTest->test_id = $id;
                    $LaboratoryTest->save();
                }
            }

            //Update Lab Metadata
            $EditLaboratoryMetadata = LaboratoryMetadata::where('laboratory_id', $request->lab_id)->first();
            if ($request->file("thumbnail")) {
                $LabImage = $request->file("thumbnail");
                $thumbnail = time() . "." . $LabImage->getClientOriginalExtension();
                $fullUrl = $LabImage->move("images/laboratory", $thumbnail);
                $EditLaboratoryMetadata->image = env('IMAGE_BASE_URL') . '/' . $fullUrl;
            }

            $EditLaboratoryMetadata->open_time = $request->opening_time;
            $EditLaboratoryMetadata->close_time = $request->ending_time;
            //  $EditLaboratoryMetadata->is_partner = $request->is_partner;

            if ($request->has('is_partner')) {
                $EditLaboratoryMetadata->is_partner = 1;
            } else {
                $EditLaboratoryMetadata->is_partner = 0;
            }

            $EditLaboratoryMetadata->charges = $request->charges;
            $EditLaboratoryMetadata->email = $request->email;
            $EditLaboratoryMetadata->country_code = $request->country_code;
            $EditLaboratoryMetadata->phone_number = $request->phone_number;
            if ($request->has('discount')) {
                $EditLaboratoryMetadata->discount = $request->discount;
            } else {
                $EditLaboratoryMetadata->discount = null;
            }

            $EditLaboratoryMetadata->address = $request->address;
            $EditLaboratoryMetadata->city = $request->txtCity;
            $EditLaboratoryMetadata->state = $request->state;
            $EditLaboratoryMetadata->country = $request->country;
            $EditLaboratoryMetadata->latitude = $request->lat;
            $EditLaboratoryMetadata->longitude = $request->lng;
            $EditLaboratoryMetadata->status = $request->status;
            if ($EditLaboratoryMetadata->update()) {
                return redirect()
                    ->route("laboratories_list")
                    ->with("success", "Laboratory has been updated successfully!");
            }

        }

        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->route("laboratory.list")
        //         ->with("error", "something went wrong");
        // }
    }

    public function viewLaboratory($id)
    {
        if (Auth::user()->can('view_laboratories')) {
            $LaboratoryData = Laboratory::with('LaboratoryMetadata')->where('id', $id)->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            $AllActiveGeneticTest = Test::where('status', 1)->get();
            $LaboratoryTests = LaboratoryTest::where('laboratory_id', $id)->get();
            $genetic_test_types = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
            return view('laboratory.view', compact('LaboratoryData', 'status', 'AllActiveGeneticTest', 'genetic_test_types', 'LaboratoryTests'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function deleteLaboratory(Request $request)
    {

        $Laboratory = Laboratory::where('id', $request->id)->first();
        if ($Laboratory) {
            $Laboratory->delete();
            return response()->json([
                'success' => 1,
            ]);
        } else {
            return response()->json([
                'success' => 0,
            ]);
        }
    }

    public function LaboratoryVerifications(Request $request)
    {

        if ($request->action == 'approve') {
            $approveLaboratory = Laboratory::where('id', $request->id)->first();
            $approveLaboratory->lab_status = Status::where(['module_name' => 'Document', 'slug' => 'document_approved'])->value('id');
            $approveLaboratory->status = 1;
            if ($approveLaboratory->update()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Approved',
                ]);
            }

            //Send Mail.......

            // $data = array('name' => "Mithilesh Kumars");

            //   \Mail::send(['html' => 'mail'], $data, function ($message) {
            //       $message->to('mithilesh_kumar@rvtechnologies.com', 'Mithilesh S1')->subject
            //           ('Testing Mail');
            //       $message->from('mithileshkumar6649@gmail.com', 'Mithilesh S2');
            //   });

        } else if ($request->action == 'reject') {

            $approveLaboratory = Laboratory::where('id', $request->id)->first();
            $approveLaboratory->lab_status = Status::where(['module_name' => 'Document', 'slug' => 'document_rejected'])->value('id');
            $approveLaboratory->status = 0;
            if ($approveLaboratory->update()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Reject',
                ]);
            }

        }

    }
}
