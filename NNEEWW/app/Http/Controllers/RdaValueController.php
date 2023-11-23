<?php

namespace App\Http\Controllers;
use App\Models\RdaValue;
use DB;
use Illuminate\Http\Request;

class RdaValueController extends Controller
{
     public function RdaValueList(){
           $allRdaValues = RdaValue::get(); 
           $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
           $rdaGroupCategories = DB::table('md_dropdowns')->where('module', 'rda_group_categories')->get();
           $rdaParticularsValues = DB::table('md_dropdowns')->where('module', 'rda_particulars_values')->get();
            return view('rda.list', ['allRdaValues' => $allRdaValues, 'status' => $status]);
     }

     public function RdaValueAdd(){
           $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
           $rdaGroupCategories = DB::table('md_dropdowns')->where('module', 'rda_group_categories')->get();
           $rdaParticularsValues = DB::table('md_dropdowns')->where('module', 'rda_particulars_values')->get();
             return view('rda.add',compact('status','rdaParticularsValues','rdaGroupCategories'));
     }

     public function RdaValueSave(Request $request){
         $allRdaValues =   RdaValue::create($request->all());
            return redirect()->route('rda_value_list')->with(['success' => 'RDA has been created successfully!']);
     }

      public function editRdaValue($id)
    {
        $data = RdaValue::where('id', $id)->first();
         $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
           $rdaGroupCategories = DB::table('md_dropdowns')->where('module', 'rda_group_categories')->get();
           $rdaParticularsValues = DB::table('md_dropdowns')->where('module', 'rda_particulars_values')->get();
      
        return view('rda.edit',compact('data','status','rdaParticularsValues','rdaGroupCategories'));
    }

      public function updateRdaValue(Request $request){
       //  dd($request->all());

         RdaValue::where('id',$request->rad_id)->update([
             'category'=>$request->category,
             'particulars'=>$request->particulars,
             'energy_ear'=>$request->energy_ear,
             'protein_ear'=>$request->protein_ear,
             'protein_rda'=>$request->protein_rda,
             'dietary_fibre'=>$request->dietary_fibre,
             'calcium_ear'=>$request->calcium_ear,
             'calcium_rda'=>$request->calcium_rda,
             'calcium_tul'=>$request->calcium_tul,
             'magnesium_ear'=>$request->magnesium_ear,
             'magnesium_rda'=>$request->magnesium_rda,
             'magnesium_tul'=>$request->magnesium_tul,
             'iron_ear'=>$request->iron_ear,
             'iron_rda'=>$request->iron_rda,
             'iron_tul'=>$request->iron_tul,
             'zinc_ear'=>$request->zinc_ear,
             'zinc_rda'=>$request->zinc_rda,
             'zinc_tul'=>$request->zinc_tul,
             'iodine_ear'=>$request->iodine_ear,
             'iodine_rda'=>$request->iodine_rda,
             'iodine_tul'=>$request->iodine_tul,
             'thiamine_ear'=>$request->thiamine_ear,
             'thiamine_rda'=>$request->thiamine_rda,
             'riboflavin_ear'=>$request->riboflavin_ear,
             'riboflavin_rda'=>$request->riboflavin_rda,
             'niacin_ear'=>$request->niacin_ear,
             'niacin_rda'=>$request->niacin_rda,
             'niacin_tul'=>$request->niacin_tul,
             'vitamin_b_6_ear'=>$request->vitamin_b_6_ear,
             'vitamin_b_6_rda'=>$request->vitamin_b_6_rda,
             'vitamin_b_6_tul'=>$request->vitamin_b_6_tul,
             'folate_ear'=>$request->folate_ear,
             'folate_rda'=>$request->folate_rda,
             'folate_tul'=>$request->folate_tul,
             'vitamin_b_12_ear'=>$request->vitamin_b_12_ear,
             'vitamin_b_12_rda'=>$request->vitamin_b_12_rda,
             'vitamin_c_ear'=>$request->vitamin_c_ear,
             'vitamin_c_rda'=>$request->vitamin_c_rda,
             'vitamin_c_tul'=>$request->vitamin_c_tul,
             'vitamin_a_ear'=>$request->vitamin_a_ear,
             'vitamin_a_rda'=>$request->vitamin_a_rda,
             'vitamin_a_tul'=>$request->vitamin_a_tul,
             'vitamin_d_ear'=>$request->vitamin_d_ear,
             'vitamin_d_rda'=>$request->vitamin_d_rda,
             'vitamin_d_tul'=>$request->vitamin_d_tul,
             'selenuim'=>$request->selenuim
        ]);
          return redirect()->route('rda_value_list')->with(['success' => 'RDA has been updated successfully!']);

     }

       public function viewRdaValue($id)
    {
        $data = RdaValue::where('id', $id)->first();
         $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
           $rdaGroupCategories = DB::table('md_dropdowns')->where('module', 'rda_group_categories')->get();
           $rdaParticularsValues = DB::table('md_dropdowns')->where('module', 'rda_particulars_values')->get();
      
        return view('rda.view',compact('data','status','rdaParticularsValues','rdaGroupCategories'));
    }

}
