<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use DB;
use App\Models\BranchLocality;
use App\Exports\BranchExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreLocalityRequest;
use Auth;
class   BranchLocaltiyController extends Controller
{
      
    public function list(){

          if (Auth::user()->can("branch_locality_management")) {

         $branches = Branch::orderBY('id','desc')->get(); 
         $status = DB::table('md_dropdowns')->where('slug', 'status_data')
            ->get();
         $city=DB::table('cities')->orderBy('city')->where('status','1')->get();
         $branchLocalitiesCities = BranchLocality::pluck('city_id')->toArray();

        return view('branches.locality.list',compact('branches','status','city','branchLocalitiesCities'));

         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

 
    public function listlicality(Request $request){
      
        $branch_id=$request->id; 
        $addcity = BranchLocality::pluck('city_id')->toArray();
        $branchcity=BranchLocality::with('city')->where('branch_id',$request->id)->get();
        $city=DB::table('cities')->orderBy('city')->whereNotIn('id',$addcity)->where('status','1')->get();
        $branches = Branch::orderBY('id','desc')->get(); 
       
        $html=view('branches.locality.partial-city',compact('branch_id','city','branches'))->render();
           
           return response()->json([

              'status'=>'success',
              'html'=>$html
            ]);
    }
 
    public function viewBranchLocality(Request $request)
    {
        $branch_id=$request->id;
        $branches = Branch::orderBY('id','desc')->get(); 
        $branchcity=BranchLocality::with('city')->where('branch_id',$branch_id)->get();
      
        $cityWithoutcurrent = BranchLocality::whereNotIn('branch_id',[$branch_id])->pluck('city_id')->toArray();
        $city=DB::table('cities')->orderBy('city')->whereNotIn('id',$cityWithoutcurrent)->where('status','1')->get();

        $holeaddcity=BranchLocality::pluck('city_id')->toArray();
        $newcity=DB::table('cities')->orderBy('city')->whereNotIn('id',$holeaddcity)->where('status','1')->get();

       $html=view('branches.locality.branch_view_locality',compact('branch_id','branches','branchcity','city','cityWithoutcurrent','newcity'))->render();
       
       return response()->json([

          'status'=>'success',
          'html'=>$html
        ]);
    }

    
    public function editBranchLocalty(Request $request)
    {
        $branch_id=$request->id;
         
        $branches = Branch::orderBY('id','desc')->get(); 
        $branchcity=BranchLocality::with('city')->where('branch_id',$request->id)->get();
        $allCitesSelected = BranchLocality::where('branch_id',$request->id)->pluck('city_id')->toArray();
        
        $branchLocalitiesCities = BranchLocality::whereNotIn('branch_id',[$request->id])->pluck('city_id')->toArray();
        
        $city=DB::table('cities')->orderBy('city')->whereNotIn('id',$branchLocalitiesCities)->where('status','1')->get();
         

        $branchcityAll=BranchLocality::where('branch_id',$request->id)->pluck('city_id')->toArray();
      //  dd($branchcityAll);

        $html=view('branches.locality.edit-partial-city',compact('branch_id','branches','branchcity','city','branchLocalitiesCities','allCitesSelected','branchcityAll'))->render();
      
     
       return response()->json([

          'status'=>'success',
          'html'=>$html
        ]);

    } 

    public function downloadHtml(Request $request)
    { 
          $branch_id=$request->id;
        return Excel::download(new BranchExport($branch_id), 'BranchLocality.xlsx');

    }

    public function editSaveLocality(Request $request)
    {
       
       $flg=0; 
            
        BranchLocality::where('branch_id',$request->editbranch_id)->forceDelete();
               
        foreach($request->branch_id as $key=>$value)
        {
                  $bncity=new BranchLocality();
                  $bncity->branch_id=$request->branch_id[$key];
                  $bncity->city_id=$request->localities_id[$key];
                  $bncity->status=1;
                  $bncity->minimum_order_amount=$request->minimum_order_amount[$key];
                  $bncity->delivery_fee=$request->delivery_fee[$key];
                  $bncity->delivery_time=$request->delivery_time[$key];
                  $bncity->save(); 
               
               $flg++;
            
        }

        if($flg>0)
        {
            return response()->json([
               'status'=>'success',
               'msg'=>'Branch locality updated successfully'
             ]);
        }else
        {
             return response()->json([
               'status'=>'wrong',
               'msg'=>'Something went wrong!'
             ]); 
        }



    }


    public function saveLoyalty(Request $request)
    {
         $flg=0;

       foreach($request->localities_id as $key=>$value)
       {
       
          $bcity=new BranchLocality();
          $bcity->branch_id=$request->branch_id;
          $bcity->city_id=$request->localities_id[$key];
          $bcity->status=1;
          $bcity->minimum_order_amount=$request->minimum_order_amount[$key];
          $bcity->delivery_fee=$request->delivery_fee[$key];
          $bcity->delivery_time=$request->delivery_time[$key];
          $bcity->save();
          
          $flg++;
       }

        if($flg>0)
        {
            return response()->json([
               'status'=>'success',
               'msg'=>'Branch locality added successfully'
             ]);
        }else
        {
             return response()->json([
               'status'=>'wrong',
               'msg'=>'Something went wrong!'
             ]); 
        }

    }


   public function deleteLocalityCity(Request $request)
   {
    
    $flg=0;
    $data=BranchLocality::where('id',$request->id)->first();
 
     if($data){
             $flg++;
            $data->delete();
      }
       
        if($flg>0)
        {
            return response()->json([
               'status'=>'success',
               'msg'=>'Branch locality delete successfully'
             ]);
        }else
        {
             return response()->json([
               'status'=>'wrong',
               'msg'=>'Something went wrong!'
             ]); 
        }
   }



}
