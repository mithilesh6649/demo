<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\LaboratoryTest;
use DB;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function geneticTestList()
    {
        // Test::WIDTH;
        $AllGeneticTest = Test::all();
        $genetic_test_type = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('genetic_test.list', ['AllGeneticTest' => $AllGeneticTest, 'genetic_test_types' => $genetic_test_type]);
    }

    public function addGeneticTest()
    {
        $genetic_test_type = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('genetic_test.add', compact('genetic_test_type', 'status'));
    }

    public function saveGeneticTest(Request $request)
    {
        //  return env('APP_URL');

        $getTest = new Test();
        $getTest->name = $request->name;
        $getTest->type = $request->type;
        $getTest->status = $request->status;
        $getTest->description = $request->description;
        $getTest->add_info = $request->additional_info;
        $getTest->amount = $request->amount;

        if ($request->file("thumbnail")) {
            $GenTestImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $GenTestImage->getClientOriginalExtension();
            $GenTestImage->move("images/media", $thumbnail);
            $getTest->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
        }

        if ($getTest->save()) {

            return redirect()->route('genetic_test_list')->with(['success' => 'Test  has been created successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function viewGeneticTest($id)
    {
        $data = Test::where('id', $id)->first();
        $genetic_test_type = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('genetic_test.view', compact('genetic_test_type', 'status', 'data'));
    }

    public function editGeneticTest($id)
    {
        $data = Test::where('id', $id)->first();
        $genetic_test_type = DB::table('md_dropdowns')->where('slug', 'genetic_test_type')->get();
        $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
        return view('genetic_test.edit', compact('genetic_test_type', 'status', 'data'));
    }

    public function updateGeneticTest(Request $request)
    {
        //dd($request->all());

        $getTest = Test::where('id', $request->genetic_test_id)->first();
        $getTest->name = $request->name;
        $getTest->type = $request->type;
        $getTest->status = $request->status;
        $getTest->description = $request->description;
        $getTest->add_info = $request->additional_info;
        $getTest->amount = $request->amount;

        if ($request->file("thumbnail")) {
            $GenTestImage = $request->file("thumbnail");
            $thumbnail = time() . "." . $GenTestImage->getClientOriginalExtension();
            $GenTestImage->move("images/media", $thumbnail);
            $getTest->image = env('IMAGE_BASE_URL') . '/images/media/' . $thumbnail;
        }

        if ($getTest->update()) {

            return redirect()->route('genetic_test_list')->with(['success' => 'Test  has been updated successfully!']);
        } else {
            return redirect()->back()->with('warning', 'Something went wrong!');
        }

    }

    public function deleteGeneticTest(Request $request)
    {

        // $Test = Test::where('id', $request->id)->first();
        // if ($Test) {
        //     $Test->delete();
        //     return response()->json([
        //         'success' => 1,
        //     ]);
        // } else {
        //     return response()->json([
        //         'success' => 0,
        //     ]);
        // }

        $test = Test::where('id', $request->id)->first();
        $test_associated_labs = LaboratoryTest::where('test_id', $request->id)->count();

        if($test_associated_labs > 0) {
            $res['success'] = 0;
            $res['message'] = "You cannot delete this record as it's being used.";
            return json_encode($res);
        }
        else {
         
         $deletetest = $test->delete();
         if($deletetest) {
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


    public function geneticTestAdditionalDiscountList(){
           $PreventiveGeneticTestCount = Test::where('type',2)->get();
           $genetic_test_pricing = DB::table('md_dropdowns')->where('module','genetic_test_pricing')->get();
          return view('genetic_test.additional_discount.list',compact('genetic_test_pricing','PreventiveGeneticTestCount'));
    }


    public function geneticTestAdditionalDiscountEdit($id){
          $PreventiveGeneticTestCount = Test::where('type',2)->get();
             $data =  DB::table('md_dropdowns')->where('id',$id)->first();
              return view('genetic_test.additional_discount.edit',compact('data','PreventiveGeneticTestCount'));
    }

    public function geneticTestAdditionalDiscountView($id){
         $PreventiveGeneticTestCount = Test::where('type',2)->get();
          $data =  DB::table('md_dropdowns')->where('id',$id)->first();
          return view('genetic_test.additional_discount.view',compact('data','PreventiveGeneticTestCount'));        
    }

    public function geneticTestAdditionalDiscountUpdate(Request $request){
        //return $request->all();
         
          if($request->data_slug == 'any_two_pricing')
             {
            DB::table('md_dropdowns')->where('id',$request->additional_test_id)->update(['name'=>$request->test_count , 'value'=>$request->amount]);
             }
          else if($request->data_slug == 'all_six_pricing')
             {
           DB::table('md_dropdowns')->where('id',$request->additional_test_id)->update(['name'=>$request->all_test_count , 'value'=>$request->amount]);
             }
         else
             {
           DB::table('md_dropdowns')->where('id',$request->additional_test_id)->update(['name'=>'0', 'value'=>$request->amount]);
              } 

           return redirect()->route('additional_test_discount')->with(['success' => 'Additional Test Discount  has been updated successfully!']);      

    }

}
