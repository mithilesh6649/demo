<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\branchStaffs;
use App\Models\BranchTip;
use App\Models\BranchTipBalances;
use App\Models\BranchTipDistributions;
use App\Models\GenerateTipReport;
use App\Models\Staff;
use Carbon\Carbon;
use DB,Auth;
use Illuminate\Http\Request;
use Session;

class TipReportController extends Controller
{

    public function index()
    {
         if (Auth::user()->can("tip_report_tab_management")) {
        $all_active_branches = Branch::where("status", 1)->get();

        $selected_branch = $all_active_branches[0]->id;
        $selected_date = [
            date('d/m/Y'),
            date('d/m/Y'),
        ];

        $report_date_1 = str_replace("/", "-", $selected_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $selected_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $branch_tip_report = BranchTip::where(['tip_type' => 'tip', 'branch_id' => $all_active_branches[0]['id']])
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderBy('report_date', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->report_date)->format('Y-m');
            });

        return view('report/tip-reports/index', compact('branch_tip_report', 'all_active_branches', 'selected_branch', 'selected_date'));

           } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    // public function add_branch_tip()
    // {
    //     return view('report/tip-reports/add');
    // }

    public function edit_branch_tip($id)
    {

        $branch_tip_report = BranchTip::where('id', $id)->first();

        return view('report/tip-reports/edit', compact('branch_tip_report'));
    }

    // public function save_branch_tip(Request $request)
    // {

    //     $date = str_replace("/", "-", $request->report_date);
    //     $reportdate = date('Y-m-d H:00:00', strtotime($date));

    //     $BranchTip = new BranchTip;

    //     $BranchTip->branch_id = Session::get('branch_id');
    //     $BranchTip->manager_id = Auth::id();
    //     $BranchTip->tip_type = 'tip';
    //     $BranchTip->amount = $request->amount;
    //     $BranchTip->report_date = $reportdate;

    //     if ($BranchTip->save()) {

    //         $branchTipl = BranchTipBalances::where('branch_id', Session::get('branch_id'))->orderBy('created_at', 'DESC')->first();

    //         if ($branchTipl) {
    //             $BranchTips = new BranchTipBalances;
    //             $BranchTips->branch_id = Session::get('branch_id');
    //             $BranchTips->manager_id = Auth::id();
    //             $BranchTips->opening_balance = $branchTipl->closing_balance;
    //             $BranchTips->tip_received = $request->amount;
    //             $BranchTips->tip_distributed = 0;
    //             $BranchTips->closing_balance = ($branchTipl->closing_balance + $request->amount);
    //             $BranchTips->branch_tip_id = $BranchTip->id;
    //             $BranchTips->branch_tip_distribution_id = null;
    //             $BranchTips->date = date('Y-m-d');
    //             $BranchTips->save();

    //         } else {

    //             $BranchTips = new BranchTipBalances;
    //             $BranchTips->branch_id = Session::get('branch_id');
    //             $BranchTips->manager_id = Auth::id();
    //             $BranchTips->opening_balance = 0;
    //             $BranchTips->tip_received = $request->amount;
    //             $BranchTips->tip_distributed = 0;
    //             $BranchTips->closing_balance = ($request->amount);
    //             $BranchTips->branch_tip_id = $BranchTip->id;
    //             $BranchTips->branch_tip_distribution_id = null;
    //             $BranchTips->date = date('Y-m-d');
    //             $BranchTips->save();
    //         }

    //         return redirect()->route('branch-tip')->with("success", "Branch Tip has been added successfully!");
    //     } else {
    //         return redirect()->route('branch-tip')->with("error", "something went wrong");
    //     }

    // }

    public function update_branch_tip(Request $request)
    {
        $date = str_replace("/", "-", $request->report_date);
        $reportdate = date('Y-m-d H:00:00', strtotime($date));
        $Report = BranchTip::where('id', $request->id)->first();
        $Report->report_date = $reportdate;
        $Report->amount = $request->amount;

        if ($Report->update()) {

            BranchTipBalances::expenseAmountUpdated($Report->id);

            return redirect()->route('branch-tip')->with("success", "Branch Tip has been updated successfully!");
        } else {
            return redirect()->route('branch-tip')->with("error", "something went wrong");
        }
    }

    ///tip rider

    public function tipriderlist()
    {

        $all_active_branches = Branch::where("status", 1)->get();

        $selected_branch = $all_active_branches[0]->id;
        $selected_date = [
            date('d/m/Y'),
            date('d/m/Y'),
        ];

        $report_date_1 = str_replace("/", "-", $selected_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $selected_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $branch_tip_report = BranchTip::where(['tip_type' => 'rider', 'branch_id' => $all_active_branches[0]['id']])
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderBy('report_date', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->report_date)->format('Y-m');
            });
        return view('report/tip-reports.tip-rider', compact('branch_tip_report', 'all_active_branches', 'selected_branch', 'selected_date'));
    }

    // public function addtiprider()
    // {
    //     return view('report/tip-reports.add-tip-rider');
    // }

    // public function savetiprider(Request $request)
    // {
    //     $date = $request->year . '-' . $request->month . '-' . '01';
    //     $reportdate = date('Y-m-d', strtotime($date));

    //     $tiprider = new BranchTip;
    //     $tiprider->branch_id = Session::get('branch_id');
    //     $tiprider->manager_id = Auth::id();
    //     $tiprider->tip_type = 'rider';
    //     $tiprider->amount = $request->amount;
    //     $tiprider->report_date = $reportdate;

    //     if ($tiprider->save()) {

    //         $branchTipl = BranchTipBalances::where('branch_id', Session::get('branch_id'))->orderBy('created_at', 'DESC')->first();

    //         if ($branchTipl) {
    //             $BranchTips = new BranchTipBalances;
    //             $BranchTips->branch_id = Session::get('branch_id');
    //             $BranchTips->manager_id = Auth::id();
    //             $BranchTips->opening_balance = $branchTipl->closing_balance;
    //             $BranchTips->tip_received = $request->amount;
    //             $BranchTips->tip_distributed = 0;
    //             $BranchTips->closing_balance = ($branchTipl->closing_balance + $request->amount);
    //             $BranchTips->branch_tip_id = $tiprider->id;
    //             $BranchTips->branch_tip_distribution_id = null;
    //             $BranchTips->date = date('Y-m-d');
    //             $BranchTips->save();

    //         } else {

    //             $BranchTips = new BranchTipBalances;
    //             $BranchTips->branch_id = Session::get('branch_id');
    //             $BranchTips->manager_id = Auth::id();
    //             $BranchTips->opening_balance = $request->amount;
    //             $BranchTips->tip_received = $request->amount;
    //             $BranchTips->tip_distributed = 0;
    //             $BranchTips->closing_balance = ($request->amount);
    //             $BranchTips->branch_tip_id = $tiprider->id;
    //             $BranchTips->branch_tip_distribution_id = null;
    //             $BranchTips->date = date('Y-m-d');
    //             $BranchTips->save();
    //         }

    //         return redirect()->route('tip-rider.list')->with("success", "Tip Rider has been added successfully!");
    //     } else {
    //         return redirect()->route('tip-rider.list')->with("error", "something went wrong");
    //     }

    // }

    public function edittiprider($id)
    {

        $branch_tip_report = BranchTip::where('id', $id)->first();

        return view('report/tip-reports.edit-tip-rider', compact('branch_tip_report'));
    }

    public function updatetiprider(Request $request)
    {

        $date = $request->year . '-' . $request->month . '-' . '01';
        $reportdate = date('Y-m-d', strtotime($date));

        $Report = BranchTip::where('id', $request->id)->first();

        $Report->amount = $request->amount;
        $Report->report_date = $reportdate;

        if ($Report->update()) {

            BranchTipBalances::expenseAmountUpdated($Report->id);

            return redirect()->route('tip-rider.list')->with("success", "Tip Rider has been updated successfully!");
        } else {
            return redirect()->route('tip-rider.list')->with("error", "something went wrong");
        }

    }

    //tipdistributionList

    public function tipdistributionList()
    {
        $all_active_branches = Branch::where("status", 1)->get();

        $selected_branch = $all_active_branches[0]->id;
        $selected_date = [
            date('d/m/Y'),
            date('d/m/Y'),
        ];

        $report_date_1 = str_replace("/", "-", $selected_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $selected_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $branch_id = $all_active_branches[0]['id'];

        $branch_tip_report = BranchTipDistributions::where(['type' => 'Special', 'branch_id' => $all_active_branches[0]['id']])
            ->where('distribution_date', '>=', $report_date_1)
            ->where('distribution_date', '<=', $report_date_2)
            ->orderby('distribution_date', 'DESC')->get();

        return view('report/tip-reports.tip-special', compact('branch_tip_report', 'all_active_branches', 'branch_id', 'selected_branch', 'selected_date'));
    }

    // public function addspecialtip()
    // {

    //     $branch_staff = branchStaffs::where('branch_id', Session::get('branch_id'))->pluck('staff_id');
    //     $allstaff = Staff::whereIn('id', $branch_staff)->with('designation_name')->get();

    //     return view('report/tip-reports.add-special', compact('allstaff'));
    // }

    // public function savespecialtip(Request $request)
    // {
    //     $date = str_replace("/", "-", $request->report_date);
    //     $reportdate = date('Y-m-d H:00:00', strtotime($date));
    //     $specialtip = new BranchTipDistributions;
    //     $specialtip->branch_id = Session::get('branch_id');
    //     $specialtip->manager_id = Auth::id();
    //     $specialtip->staff_id = $request->staff_name;
    //     $specialtip->type = 'Special';
    //     $specialtip->amount = $request->amount;
    //     $specialtip->distribution_date = $reportdate;
    //     if ($specialtip->save()) {

    //         $branchTipl = BranchTipBalances::where('branch_id', Session::get('branch_id'))->orderBy('id', 'DESC')->first();

    //         if ($branchTipl) {
    //             $BranchTips = new BranchTipBalances;
    //             $BranchTips->branch_id = Session::get('branch_id');
    //             $BranchTips->manager_id = Auth::id();
    //             $BranchTips->opening_balance = $branchTipl->closing_balance;
    //             $BranchTips->tip_received = 0;
    //             $BranchTips->tip_distributed = $request->amount;
    //             $BranchTips->closing_balance = ($branchTipl->closing_balance - $request->amount);
    //             $BranchTips->branch_tip_id = null;
    //             $BranchTips->branch_tip_distribution_id = $specialtip->id;
    //             $BranchTips->date = date('Y-m-d');
    //             $BranchTips->save();

    //         } else {

    //             $BranchTips = new BranchTipBalances;
    //             $BranchTips->branch_id = Session::get('branch_id');
    //             $BranchTips->manager_id = Auth::id();
    //             $BranchTips->opening_balance = $request->amount;
    //             $BranchTips->tip_received = 0;
    //             $BranchTips->tip_distributed = $request->amount;
    //             $BranchTips->closing_balance = ($request->amount);
    //             $BranchTips->branch_tip_id = null;
    //             $BranchTips->branch_tip_distribution_id = $specialtip->id;
    //             $BranchTips->date = date('Y-m-d');
    //             $BranchTips->save();
    //         }

    //         return redirect()->route('tip-distribution.list')->with("success", "Special Tip has been added successfully!");
    //     } else {
    //         return redirect()->route('tip-distribution.list')->with("error", "something went wrong");
    //     }

    // }
    public function editspecialtip($id, $branch_id)
    {

        $branch_staff = branchStaffs::where('branch_id', $branch_id)->pluck('staff_id');
        $allstaff = Staff::whereIn('id', $branch_staff)->with('designation_name')->get();
        $special = BranchTipDistributions::where('id', $id)->first();
        return view('report/tip-reports.edit-special', compact('special', 'allstaff'));
    }

    public function updatespecialtip(Request $request)
    {

        $date = str_replace("/", "-", $request->report_date);
        $reportdate = date('Y-m-d H:00:00', strtotime($date));

        $Report = BranchTipDistributions::where('id', $request->special_id)->first();
        $Report->distribution_date = $reportdate;
        $Report->amount = $request->amount;
        $Report->staff_id = $request->staff_name;

        if ($Report->update()) {

            BranchTipDistributions::expenseAmountUpdated($Report->id);

            return redirect()->route('tip-distribution.list')->with("success", "Special Tip has been updated successfully!");
        } else {
            return redirect()->route('tip-distribution.list')->with("error", "something went wrong");
        }

    }

    public function tipdistributionsList()
    {

        $all_active_branches = Branch::where("status", 1)->get();

        $selected_branch = $all_active_branches[0]->id;

        $selected_date = [
            date('d/m/Y'),
            date('d/m/Y'),
        ];

        $report_date_1 = str_replace("/", "-", $selected_date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $selected_date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $branch_id = $all_active_branches[0]['id'];

        $distributions = BranchTipDistributions::Select('distributed_batch', DB::raw('Date(distribution_date) as date'))
            ->where(['type' => 'Normal', 'branch_id' => $all_active_branches[0]['id']])
            ->where('distribution_date', '>=', $report_date_1)
            ->where('distribution_date', '<=', $report_date_2)
            ->groupBy('distributed_batch', 'distribution_date')
            ->orderby('distributed_batch', 'DESC')->get();

        return view('report/tip-reports.tip-distribution', compact('distributions', 'all_active_branches', 'branch_id', 'selected_branch', 'selected_date'));
    }

    // public function tipdistributionsAdd()
    // {
    //     $branch_staff = branchStaffs::where('branch_id', Session::get('branch_id'))->pluck('staff_id');
    //     $allstaff = Staff::whereIn('id', $branch_staff)->with('designation_name')->get();

    //     return view('report/tip-reports.add-distribute', compact('allstaff'));
    // }

    // public function tipdistributionsSave(Request $request)
    // {

    //     $staff_ids = $request->staff_id;

    //     $date = str_replace("/", "-", $request->report_date);
    //     $reportdate = date('Y-m-d H:00:00', strtotime($date));

    //     $dist = BranchTipDistributions::where('branch_id', Session::get('branch_id'))->orderBy('distributed_batch', 'DESC')->first();
    //     $batch = 1;

    //     if ($dist) {
    //         if ($dist->distributed_batch != null) {
    //             $batch = ($dist->distributed_batch) + 1;
    //         }
    //     }

    //     $i = 0;
    //     $flg = 0;
    //     foreach ($staff_ids as $staffid) {
    //         $distribute = new BranchTipDistributions;
    //         $distribute->branch_id = Session::get('branch_id');
    //         $distribute->manager_id = Auth::user()->id;
    //         $distribute->staff_id = $staffid;
    //         $distribute->points = $request->point[$i];
    //         $distribute->available = $request->Available_time[$i];
    //         $distribute->amount = $request->amount[$i];
    //         $distribute->type = 'Normal';
    //         $distribute->distribution_date = $reportdate;
    //         $distribute->is_distributed = 1;
    //         $distribute->distributed_batch = $batch;
    //         $distribute->save();

    //         $flg++;
    //     }

    //     if ($flg > 0) {
    //         BranchTipDistributions::where(['branch_id' => Session::get('branch_id'), 'is_distributed' => 0, 'type' => 'Special'])->update(['is_distributed' => 1, 'distributed_batch' => $batch]);

    //         BranchTip::where(['branch_id' => Session::get('branch_id'), 'is_distributed' => 0])->update(['is_distributed' => 1, 'distributed_batch' => $batch]);

    //         return redirect()->route('tip-distributions.lists')->with("success", "Distribute Tip has been added successfully!");
    //     } else {

    //         return redirect()->route('tip-distributions.lists')->with("success", "something went wrong");
    //     }

    // }

    public function TipReportFilter(Request $request)
    {

        $selected_branch = $request->branch_id;

        $all_active_branches = Branch::where("status", 1)->get();

        $report_date_1 = str_replace("/", "-", $request->date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $request->date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        if ($request->type == 'tip') {

            if ($request->from_filter != 'reset') {
                Session::put('tip_collection_report_start_date', $report_date_1);
                Session::put('tip_collection_report_end_date', $report_date_2);
                Session::put('tip_collection_report_branch_id', $request->branch_id);
            } else {
                Session::put('tip_collection_report_start_date', null);
                Session::put('tip_collection_report_end_date', null);
                Session::put('tip_collection_report_branch_id', null);

            }
        }

        if ($request->type == 'rider') {

            if ($request->from_filter != 'reset') {
                Session::put('tip_rider_report_start_date', $report_date_1);
                Session::put('tip_rider_report_end_date', $report_date_2);
                Session::put('tip_rider_report_branch_id', $request->branch_id);
            } else {
                Session::put('tip_rider_report_start_date', null);
                Session::put('tip_rider_report_end_date', null);
                Session::put('tip_rider_report_branch_id', null);

            }
        }

        $branch_tip_report = BranchTip::where(['tip_type' => $request->type, 'branch_id' => $request->branch_id])
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderBy('report_date', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->report_date)->format('Y-m');
            });

        if ($request->type == 'tip') {
            $result_view = view("report.tip-reports.partial", [
                "branch_tip_report" => $branch_tip_report,
                "selected_branch" => $selected_branch,
            ])->render();
        } else if ($request->type == 'rider') {
            $result_view = view("report.tip-reports.rider-partial", [
                "branch_tip_report" => $branch_tip_report,
                "selected_branch" => $selected_branch,
            ])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function SpecialDistributionTipReportFilter(Request $request)
    {

        $all_active_branches = Branch::where("status", 1)->get();

        $report_date_1 = str_replace("/", "-", $request->date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $request->date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $branch_tip_report = BranchTipDistributions::where(['type' => $request->type, 'branch_id' => $request->branch_id])
            ->where('distribution_date', '>=', $report_date_1)
            ->where('distribution_date', '<=', $report_date_2)
            ->orderby('distribution_date', 'DESC')
            ->get();

        if ($request->from_filter != 'reset') {
            Session::put('special_tip_distribution_start_date', $report_date_1);
            Session::put('special_tip_distribution_end_date', $report_date_2);
            Session::put('special_tip_distribution_branch_id', $request->branch_id);
        } else {
            Session::put('special_tip_distribution_start_date', null);
            Session::put('special_tip_distribution_end_date', null);
            Session::put('special_tip_distribution_branch_id', null);

        }

        if ($request->type == 'Special') {
            $result_view = view("report.tip-reports.special", [
                "branch_tip_report" => $branch_tip_report,
                "branch_id" => $request->branch_id,
            ])->render();
        }

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function DistributionTipsReportFilter(Request $request)
    {

        $all_active_branches = Branch::where("status", 1)->get();

        $report_date_1 = str_replace("/", "-", $request->date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $request->date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $distributions = BranchTipDistributions::Select('distributed_batch', DB::raw('Date(distribution_date) as date'))
            ->where(['type' => 'Normal', 'branch_id' => $request->branch_id])
            ->where('distribution_date', '>=', $report_date_1)
            ->where('distribution_date', '<=', $report_date_2)
            ->groupBy('distributed_batch', 'distribution_date')
            ->orderby('distributed_batch', 'DESC')->get();

        if ($request->from_filter != 'reset') {
            Session::put('tip_distribution_report_start_date', $report_date_1);
            Session::put('tip_distribution_report_end_date', $report_date_2);
            Session::put('tip_distribution_report_branch_id', $request->branch_id);
        } else {
            Session::put('tip_distribution_report_start_date', null);
            Session::put('tip_distribution_report_end_date', null);
            Session::put('tip_distribution_report_branch_id', null);

        }

        $result_view = view("report.tip-reports.distribute-partial", [
            "distributions" => $distributions,
            "branch_id" => $request->branch_id,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function TipReportDelete(Request $request)
    {
          
        $TipReport = BranchTip::where('id', $request->id);
         BranchTipBalances::where('branch_tip_id', $request->id)->delete();
        $TipReport = $TipReport->delete();

        if ($TipReport) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function TipDistributionReportDelete(Request $request)
    {

        $TipReport = BranchTipDistributions::where('id', $request->id);

        $TipReport = $TipReport->delete();

        if ($TipReport) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function tipdistributionsview($id, $branch_id)
    {

        $branchtip = BranchTipDistributions::where(['branch_id' => $branch_id, 'type' => 'Normal', 'is_distributed' => 1, 'distributed_batch' => $id])->get();

        $branchtipsum = BranchTipDistributions::selectRaw('SUM(branch_tip_distributions.amount) as tip_amount')->where(['branch_id' => $branch_id, 'type' => 'Normal', 'is_distributed' => 1, 'distributed_batch' => $id])->first();

        return view('report.tip-reports.view-dirtribute', compact('branchtip', 'branchtipsum'));

    }

    public function TipClosingReportFilter(Request $request)
    {

        $closing_balance = view("report.tip-reports.closing_balance_partial", [
            "selected_date" => $request->date,
            "selected_branch" => $request->branch_id,
        ])->render();

        return json_encode([
            "closing_balance" => $closing_balance,
            "status" => true,
        ]);

    }
    public function downloadTipReport($branch_id = null, $date = null)
    {
        // if (Auth::user()->can('download_sales_petty_report')) {

        $obj = new GenerateTipReport($branch_id, base64_decode($date));
        return $obj->result();
        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    // Start Tip Report Restore functionallity

    public function deletedTipReportCollectionList()
    {
        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');
        $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'tip')->onlyTrashed()->get();
        return view('report.tip-reports.tip-report-restore.tip_collection_deleted_list', compact('branch', 'allBranchDeletedReports'));
    }

    public function restoreTipReportCollection(Request $request)
    {
        $selected_dates = BranchTip::withTrashed()->where('id', $request->id)->restore();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function permanentDeleteTipReportCollection(Request $request)
    {
        
        BranchTipBalances::withTrashed()->where('branch_tip_id', $request->id)->forceDelete();
        $selected_dates = BranchTip::withTrashed()->where('id', $request->id)->forceDelete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function filterTipReportCollectionDeletedReports(Request $request)
    {

        $allBranchDeletedReports = null;
        if ($request->with == 'only_branch_id') {

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'tip')->onlyTrashed()->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'tip')->onlyTrashed()->where('branch_id', $request->branch_id)->get();
            }

            $result_view = view('report.tip-reports.tip-report-restore.tip_collection_deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

        if ($request->with == "apply_filter") {

            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'tip')->onlyTrashed()->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'tip')->onlyTrashed()->where('branch_id', $request->branch_id)->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            $result_view = view('report.tip-reports.tip-report-restore.tip_collection_deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

    }

    public function resetTipReportCollectionDeletedReports()
    {

        $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'tip')->onlyTrashed()->get();
        $result_view = view('report.tip-reports.tip-report-restore.tip_collection_deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();
        return json_encode(['html' => $result_view, 'status' => true]);

    }

    // End Tip Report Restore functionallity

    //Start Tip Rider functionality

    public function deletedTipReportRiderList()
    {
        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');
        $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'rider')->onlyTrashed()->get();
        return view('report.tip-reports.tip-report-restore.tip_rider_deleted_list', compact('branch', 'allBranchDeletedReports'));
    }

    public function restoreTipReportRider(Request $request)
    {
        $selected_dates = BranchTip::withTrashed()->where('id', $request->id)->restore();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function permanentDeleteTipReportRider(Request $request)
    {

        //BranchTipBalances::where('branch_tip_id',$request->id)->delete();
        $selected_dates = BranchTip::withTrashed()->where('id', $request->id)->forceDelete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function filterTipReportRiderDeletedReports(Request $request)
    {

        $allBranchDeletedReports = null;
        if ($request->with == 'only_branch_id') {

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'rider')->onlyTrashed()->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'rider')->onlyTrashed()->where('branch_id', $request->branch_id)->get();
            }

            $result_view = view('report.tip-reports.tip-report-restore.tip_rider_deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

        if ($request->with == "apply_filter") {

            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'rider')->onlyTrashed()->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'rider')->onlyTrashed()->where('branch_id', $request->branch_id)->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            $result_view = view('report.tip-reports.tip-report-restore.tip_rider_deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

    }

    public function resetTipReportRiderDeletedReports()
    {

        $allBranchDeletedReports = BranchTip::with('Branch')->where('tip_type', 'rider')->onlyTrashed()->get();
        $result_view = view('report.tip-reports.tip-report-restore.tip_rider_deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();
        return json_encode(['html' => $result_view, 'status' => true]);

    }

    //End Tip Rider functionality

    //Start Special Tip Destribution........

    public function deletedSpecialTipDistributionList()
    {

        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');
        $allBranchDeletedReports = BranchTipDistributions::with('Branch', 'Staff')->where('type', 'Special')->onlyTrashed()->get();
        return view('report.tip-reports.tip-report-restore.special_tip_destribution_deleted_list', compact('branch', 'allBranchDeletedReports'));

    }

    public function restoreSpecialTipDistribution(Request $request)
    {
        $selected_dates = BranchTipDistributions::withTrashed()->where('id', $request->id)->restore();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function permanentDeleteSpecialTipDistribution(Request $request)
    {

        // BranchTipBalances::where('branch_tip_id',$request->id)->delete();
        $selected_dates = BranchTipDistributions::withTrashed()->where('id', $request->id)->forceDelete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function filterSpecialTipDistributionDeletedReports(Request $request)
    {

        $allBranchDeletedReports = null;
        if ($request->with == 'only_branch_id') {

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = BranchTipDistributions::with('Branch', 'Staff')->where('type', 'Special')->onlyTrashed()->onlyTrashed()->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = BranchTipDistributions::with('Branch', 'Staff')->where('type', 'Special')->onlyTrashed()->onlyTrashed()->where('branch_id', $request->branch_id)->get();
            }

            $result_view = view('report.tip-reports.tip-report-restore.sdelete_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

        if ($request->with == "apply_filter") {

            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = BranchTipDistributions::with('Branch', 'Staff')->where('type', 'Special')->onlyTrashed()->onlyTrashed()->whereBetween('distribution_date', [$first_second, $last_second])->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = BranchTipDistributions::with('Branch', 'Staff')->where('type', 'Special')->onlyTrashed()->onlyTrashed()->where('branch_id', $request->branch_id)->whereBetween('distribution_date', [$first_second, $last_second])->get();
            }

            $result_view = view('report.tip-reports.tip-report-restore.sdelete_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

    }

    public function resetSpecialTipDistributionDeletedReports()
    {

        $allBranchDeletedReports = BranchTipDistributions::with('Branch', 'Staff')->where('type', 'Special')->onlyTrashed()->onlyTrashed()->get();
        $result_view = view('report.tip-reports.tip-report-restore.sdelete_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();
        return json_encode(['html' => $result_view, 'status' => true]);

    }

    //End Special Tip Destribution........
}
