<?php

namespace App\Http\Controllers;

use App\Http\Reports\salesreport\CarFuleReport;
use App\Models\BranchCar;
use App\Models\Branch;
use App\Models\Cars;
use App\Models\DailyPettyExpense;
use App\Models\DailyPettyExpenseDoc;
use Illuminate\Http\Request;
use Session ,Auth;
  
class FuleReportController extends Controller
{
    public function FuleReportList()
    {
            $curMonth = date('F');
            $curYear = date('Y');
            $timestamp = strtotime($curMonth . ' ' . $curYear);
            $report_date_1 = date('Y-m-01 00:00:00', $timestamp);
            $report_date_2 = date('Y-m-t 12:59:59', $timestamp);

          $all_active_branches = Branch::where("status", 1)->get();
         
          $selected_branch = $all_active_branches[0]->id;

          $all_allocated_cars = BranchCar::select('car_id')->where('branch_id',$selected_branch)->where('status', '1')->groupBy('car_id')->pluck('car_id');

          $all_active_branches_cars = Cars::whereIn('id', $all_allocated_cars)->get();
           
          $selected_branch_cars = $all_active_branches_cars[0]->id;  



        $daily_car_fule_report = DailyPettyExpense::with('car', 'driver')->where(['category_id' => "3", 'sub_category_id' => '11'])->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderByDesc("report_date")->where('branch_id',$selected_branch)->where('car_id',$selected_branch_cars)->get();
          
        //  dd($all_active_branches);
          
        //  dd($selected_branch);

          return view(
            "report.car-fule-reports.index",
            compact("daily_car_fule_report","all_active_branches",'all_active_branches_cars')
         );

        // if (Auth::user()->can("car_wise_fule_tab_management")) {
        // $all_allocated_cars = BranchCar::select('car_id')->where('status', '1')->groupBy('car_id')->pluck('car_id');

        // //   $all_active_branches = Branch::where("status", 1)->get();
        // $all_active_branches = Cars::whereIn('id', $all_allocated_cars)->get();
        // $selected_branch = $all_active_branches[0]->id;
        // //  $selected_date = [
        // //     date('d/m/Y'),
        // //     date('d/m/Y'),
        // // ];

        // $curMonth = date('F');
        // $curYear = date('Y');
        // $timestamp = strtotime($curMonth . ' ' . $curYear);
        // $report_date_1 = date('Y-m-01 00:00:00', $timestamp);
        // $report_date_2 = date('Y-m-t 12:59:59', $timestamp);

        // $daily_car_fule_report = DailyPettyExpense::with('car', 'driver')->where(['category_id' => "3", 'sub_category_id' => '11'])->where('report_date', '>=', $report_date_1)
        //     ->where('report_date', '<=', $report_date_2)
        //     ->orderByDesc("report_date")
        //     ->where('car_id', $all_active_branches[0]['id'])->get();
        // //  dd($daily_car_fule_report);

        // return view(
        //     "report.car-fule-reports.index",
        //     compact("daily_car_fule_report", "all_active_branches")
        // );

        //   } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    public function FuleReportFilter(Request $request)
    {

         //dd($request->all());

        $report_date_1 = date('Y-m-d', strtotime(str_replace("/", "-", $request->date[0])));

        $report_date_2 = date('Y-m-d', strtotime(str_replace("/", "-", $request->date[1])));

        // if ($request->from_filter != 'reset') {
        //     Session::put('car_wise_fuel_report_start_date', $report_date_1);
        //     Session::put('car_wise_fuel_report_end_date', $report_date_2);
        //     Session::put('car_wise_fuel_report_branch_id', $request->branch_id);
        // } else {
        //     Session::put('car_wise_fuel_report_start_date', null);
        //     Session::put('car_wise_fuel_report_end_date', null);
        //     Session::put('car_wise_fuel_report_branch_id', null);

        // }

        // $daily_car_fule_report = DailyPettyExpense::with('car', 'driver')->where(['category_id' => "3", 'sub_category_id' => '11'])->where("car_id", $request->branch_id)
        //     ->where('report_date', '>=', $report_date_1)
        //     ->where('report_date', '<=', $report_date_2)
        //     ->orderByDesc("report_date")->get();

           $daily_car_fule_report = DailyPettyExpense::with('car', 'driver')->where(['category_id' => "3", 'sub_category_id' => '11'])->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderByDesc("report_date")->where('branch_id',$request->branch_id)->where('car_id',$request->car_id)->get();


        $result_view = view("report.car-fule-reports.car-fule-partial", [
            "daily_car_fule_report" => $daily_car_fule_report,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function downloadcarfuleReport($branch_id = null ,$car_id = null, $date = null)
    {
 
        if ($date != null) {

            $date = base64_decode($date);

            $date = explode(',', $date); //For breaking dates //

            $date = array_map('trim', $date); // For removing any space //

            $obj = new CarFuleReport($branch_id,$car_id,$date);
            return $obj->result();
        }
    }


    public function FuleReportCarFilter(Request $request){

         $all_allocated_cars = BranchCar::select('car_id')->where('branch_id',$request->branch_id)->where('status', '1')->groupBy('car_id')->pluck('car_id');
         $all_active_branches_cars = Cars::whereIn('id', $all_allocated_cars)->get(); 

         
        $result_view = view("report.car-fule-reports.partials", [
            "all_active_branches_cars" => $all_active_branches_cars,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

        
          
    }



    public function PreviewFuleDoc(Request $request){
      

        $petty_docs = DailyPettyExpenseDoc::where('daily_petty_expense_id', $request->id)->get()->toArray();
        $petty_docs_img_count = DailyPettyExpenseDoc::where('daily_petty_expense_id', $request->id)->get('doc')->count();

        $result_view = view("report.daily-reports.petty-cash-report.doc_preview", [
            "petty_docs" => $petty_docs,
            "petty_docs_img_count" => $petty_docs_img_count,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

}
