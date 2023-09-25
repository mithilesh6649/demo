<?php

namespace App\Http\Controllers;

use App\Http\Reports\salesreport\ComplimentaryReport;
use App\Models\Branch;
use App\Models\DailySaleReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session , Auth;

class ComplimentaryController extends Controller
{

    public function list() {

         if (Auth::user()->can("sales_by_complimentary_tab_management")) {

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');
        $selbranch = Branch::select('short_name', 'id')->get()->first();

        $curMonth = date('F');
        $curYear = date('Y');
        $timestamp = strtotime($curMonth . ' ' . $curYear);
        $first_second = date('Y-m-01 00:00:00', $timestamp);
        $last_second = date('Y-m-d 12:59:59', strtotime(date('d-m-Y')));

        $current_month = Carbon::now('m');
        $current_year = Carbon::now('Y');
        $data = DailySaleReport::where('branch_id', $selbranch->id)->whereBetween('report_date', [$first_second, $last_second])->orderBy('report_date', 'DESC')->get();

        return view('report.daily-reports.sales-report.complimentary.index', compact('selbranch', 'branch', 'data'));

         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function filter(Request $request)
    {

        if (count($request->date_range) == 1) {
            $first_second = date('Y-m-01', );
            $last_second = date('Y-m-t', );
        } else {
            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));
        }
        $first_second = $first_second;
        $last_second = $last_second;
        $branch_id = $request->branch_id;

        if ($request->from_filter != 'reset') {
            Session::put('daily_sales_report_start_date', $first_second);
            Session::put('daily_sales_report_end_date', $last_second);
            Session::put('daily_sales_report_branch_id', $request->branch_id);
        } else {
            Session::put('daily_sales_report_start_date', null);
            Session::put('daily_sales_report_end_date', null);
            Session::put('daily_sales_report_branch_id', null);

        }

        $selbranch = $request->branch_id;

        $data = DailySaleReport::whereDate("report_date", ">=", date("Y-m-d", strtotime($first_second)))->whereDate("report_date", "<=", date("Y-m-d", strtotime($last_second)))->where('branch_id', $request->branch_id)->orderBy('report_date', 'DESC')->get();

        $html = view('report.daily-reports.sales-report.complimentary.partial', compact('selbranch', 'data'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);

    }

    public function Download($start = null, $end = null, $branch_id = null)
    {
        $complimentary = new ComplimentaryReport($start, $end, $branch_id);
        $complimentary->result();
    }
}
