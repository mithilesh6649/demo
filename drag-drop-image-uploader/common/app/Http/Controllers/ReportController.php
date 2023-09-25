<?php

namespace App\Http\Controllers;

use App\Http\Reports\GenerateBranchPettyCashReport;
use App\Http\Reports\GenerateCreditCardDailyReport;
use App\Http\Reports\GenerateCreditCardReportByBranch;
use App\Http\Reports\GenerateCreditCardReportByMonth;
use App\Http\Reports\GenerateReportByBranchMonthWise;
use App\Http\Reports\GenerateSalesAndPettyCashReport;
use App\Http\Reports\GenerateSalesReport;
use App\Http\Reports\GenerateSingleBranchMonthlyReport;
use App\Models\Branch;
use App\Models\BranchCar;
use App\Models\DailyPettyExpense;
use App\Models\DailyPettyExpenseBalance;
use App\Models\DailyPettyExpenseCategory;
use App\Models\DailyPettyExpenseDoc;
use App\Models\DailyPettyExpenseSubCategory;
use App\Models\DailySaleReport;
use App\Models\MdDropdown;
use App\Models\User;
use Auth,Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class ReportController extends Controller
{
    public function index()
    {
        $daily_report_sales = DailySaleReport::get();
        return view("report/index", compact("daily_report_sales"));
    }

    public function view_report($id)
    {
        $daily_report_sales = DailySaleReport::with("Branch")
            ->where("id", $id)
            ->first();
        return view("report/view", compact("daily_report_sales"));
    }

    public function filterReports(Request $request)
    {
        $date_range = $request->date_range;

        $daily_report_sales = DailySaleReport::orderByDesc("created_at")
            ->where(
                "created_at",
                ">=",
                date("Y-m-d", strtotime($date_range[0]))
            )
            ->where(
                "created_at",
                "<=",
                date("Y-m-d", strtotime($date_range[1]))
            )
            ->get();

        $result_view = view("report.partial", [
            "daily_report_sales" => $daily_report_sales,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);
    }

    public function reset(Request $request)
    {
        $date_range = $request->date_range;

        $daily_report_sales = DailySaleReport::orderByDesc("created_at")->get();

        $result_view = view("report.partial", [
            "daily_report_sales" => $daily_report_sales,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);
    }

    public function editRvNumber(Request $request)
    {
        DailySaleReport::where("id", $request->report_id)
            ->first()
            ->update(["rv_number" => $request->rv_number]);
        return response()->json([
            "success" => true,
            "status" => "true",
        ]);
    }

    public function CreditCardReportList()
    {
        if (Auth::user()->can('card_commission_tab_management')) {

            $branches = Branch::where("status", Branch::ACTIVE)->get();

            $selected_branch = $branches[0]->id;

            $selected_date = [
                date('d/m/Y'),
                date('d/m/Y'),
            ];

            $report_date_1 = str_replace("/", "-", $selected_date[0]);
            $report_date_1 = date('Y-m-d', strtotime($report_date_1));

            $report_date_2 = str_replace("/", "-", $selected_date[1]);
            $report_date_2 = date('Y-m-d', strtotime($report_date_2));
            // $dates = [];

            // for($i = 1; $i <=  date('t'); $i++){
            //     $dates[] = date('Y')."-".date('m')."-".str_pad($i, 2, '0', STR_PAD_LEFT);
            // }

            $card_report = DailySaleReport::where(['branch_id' => $selected_branch])
                ->where('report_date', '>=', $report_date_1)
                ->where('report_date', '<=', $report_date_2)
                ->where(function ($q) {
                    return $q->whereNotNull('amex')
                        ->orWhereNotNull('visa')
                        ->orWhereNotNull('master')
                        ->orWhereNotNull('dinner')
                        ->orWhereNotNull('knet')
                        ->orWhereNotNull('mm_online_link');
                })
                ->orderBy('report_date', 'DESC')
                ->orderBY('id', 'DESC')
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->report_date)->format('Y-m-d');
                });

            return view("report.daily-reports.credit-card-report.index")->with([
                'branches' => $branches,
                'selected_branch_id' => $branches[0]->id,
                'card_report' => $card_report,
            ]);
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function CreditCardReportByBranchList()
    {
        if (Auth::user()->can('card_reports_by_branch_tab_management')) {

            $branches = Branch::where("status", Branch::ACTIVE)->get();

            $selected_branch = $branches[0]->id;

            $card_reports = DailySaleReport::where(['branch_id' => $selected_branch])
                ->whereYear('report_date', date('Y'))
                ->where(function ($q) {
                    return $q->whereNotNull('amex')
                        ->orWhereNotNull('visa')
                        ->orWhereNotNull('master')
                        ->orWhereNotNull('dinner')
                        ->orWhereNotNull('knet')
                        ->orWhereNotNull('mm_online_link');
                })
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->report_date)->format('Y-m');
                });

            return view("report.daily-reports.credit-card-report.branch")->with([
                'branches' => $branches,
                'selected_branch_id' => $branches[0]->id,
                'card_reports' => $card_reports,
                // 'year' => date('Y'),
            ]);
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function CreditCardReportByMonthList()
    {

        if (Auth::user()->can("credit_card_report_by_month_tab_management")) {
            $branches = Branch::where("status", Branch::ACTIVE)->get();
            return view("report.daily-reports.credit-card-report.month")->with([
                'branches' => $branches,
                'year' => date('Y'),
                'month' => date('m'),
            ]);

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function CreditCardReportByMonthFilter(Request $request)
    {
        try {

            $branches = Branch::where("status", Branch::ACTIVE)->get();
            $html = view("report.daily-reports.credit-card-report.month_partial")->with([
                'branches' => $branches,
                'year' => $request->year,
                'month' => $request->month,
            ])->render();

            //Start filter prevent.....

            if ($request->from_filter != 'reset') {
                Session::put('credit_card_report_by_month_month', $request->month);
                Session::put('credit_card_report_by_month_year', $request->year);
            } else {
                Session::put('credit_card_report_by_month_month', null);
                Session::put('credit_card_report_by_month_year', null);

            }

            return response()->json([
                'status' => true,
                'data' => $html,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }
    }

    public function CreditCardReportByMonthDownload($month = null, $year = null)
    {
        $report = new GenerateCreditCardReportByMonth($month, $year);
        return $report->report();
    }

    public function CreditCardReportByBranchFilter(Request $request)
    {
        // dd($request->all());
        // ->whereYear('report_date', date('Y'))
        try {

            $card_reports = DailySaleReport::where(['branch_id' => $request->branch_id])
                ->whereYear('report_date', $request->year)
                ->where(function ($q) {
                    return $q->whereNotNull('amex')
                        ->orWhereNotNull('visa')
                        ->orWhereNotNull('master')
                        ->orWhereNotNull('dinner')
                        ->orWhereNotNull('knet')
                        ->orWhereNotNull('mm_online_link');
                })
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->report_date)->format('Y-m');
                });

            //Start filter prevent.....

            if ($request->from_filter != 'reset') {
                Session::put('credit_card_report_by_branch_branch_id', $request->branch_id);
                Session::put('credit_card_report_by_branch_year', $request->year);
            } else {
                Session::put('credit_card_report_by_branch_branch_id', null);
                Session::put('credit_card_report_by_branch_year', null);

            }

            $header = view("report.daily-reports.credit-card-report.branch_header")->render();

            $html = view("report.daily-reports.credit-card-report.branch_partial")->with([
                'selected_branch_id' => $request->branch_id,
                'year' => $request->year, // date('Y'),
                'card_reports' => $card_reports,
            ])->render();

            return response()->json([
                'status' => true,
                'data' => $html,
                'header' => $header,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }
    }

    public function CreditCardReportFilter(Request $request)
    {
        try {

            $lower_date = date('Y-m-d', strtotime(str_replace("/", "-", $request->date_range[0])));
            $higher_date = date('Y-m-d', strtotime(str_replace("/", "-", $request->date_range[1])));

            $card_report = DailySaleReport::where(['branch_id' => $request->branch_id])
                ->where('report_date', '>=', $lower_date)
                ->where('report_date', '<=', $higher_date)
                ->where(function ($q) {
                    return $q->whereNotNull('amex')
                        ->orWhereNotNull('visa')
                        ->orWhereNotNull('master')
                        ->orWhereNotNull('dinner')
                        ->orWhereNotNull('knet')
                        ->orWhereNotNull('mm_online_link');
                })
                ->orderBy('report_date', 'DESC')
                ->orderBY('id', 'DESC')
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->report_date)->format('Y-m-d');
                });

            if ($request->from_filter != 'reset') {
                Session::put('credit_card_commission_report_start_date', $lower_date);
                Session::put('credit_card_commission_report_end_date', $higher_date);
                Session::put('credit_card_commission_report_branch_id', $request->branch_id);
            } else {
                Session::put('credit_card_commission_report_start_date', null);
                Session::put('credit_card_commission_report_end_date', null);
                Session::put('credit_card_commission_report_branch_id', null);

            }
            $header = view("report.daily-reports.credit-card-report.credit_partial")->render();

            $html = view("report.daily-reports.credit-card-report.partial")->with([
                'selected_branch_id' => $request->branch_id,
                'card_report' => $card_report,
            ])->render();

            return response()->json([
                'status' => true,
                'data' => $html,
                'header' => $header,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }
    }

    public function CreditCardReportDownload($branch_id = null, $date_range = null)
    {
        if (Auth::user()->can('download_credit_card_report')) {

            $report = new GenerateCreditCardDailyReport($branch_id, $date_range);
            return $report->report();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function CreditCardReportByBranchDownload($branch_id = null, $year = null)
    {
        if (Auth::user()->can('download_sales_report')) {

            $report = new GenerateCreditCardReportByBranch($branch_id, $year);
            return $report->report();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function SalesReportList()
    {
        return view("report.daily-reports.sales-report.index");
    }

    public function SalesReportView()
    {
    }

    public function SalesReportDownload()
    {
        $obj = new GenerateSalesReport();
        $obj->result();
    }

    public function PettyCashReportBranch()
    {

        if (Auth::user()->can('branch_petty_cash_tab_management')) {
            $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
            $branches = Branch::where("status", 1)->get();

            $reports = DailyPettyExpense::where('branch_id', $branches[0]['id'])->orderBy('report_date', 'DESC')->get();

            return view(
                "report.daily-reports.petty-cash-report.branch",
                compact("branches", "categories", "reports")
            );

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function EditPettyCashReportBranch($id)
    {
        return view('report.daily-reports.petty-cash-report.branch-edit');
    }

    public function getExpense($subcategory, $month)
    {
        return DailyPettyExpense::whereMonth("created_at", $month)
            ->where("category_id", $subcategory->category_id)
            ->where("sub_category_id", $subcategory->id)
            ->sum("amount");
    }

    public function DownloadBranchPettyCashReport($branch_id = null, $date_range = null)
    {
        if (Auth::user()->can('download_branch_petty_cash_report')) {
            $obj = new GenerateBranchPettyCashReport($branch_id, $date_range);
            return $obj->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function downloadSalesAndPettyReport($branch_id = null, $date = null)
    {
        if (Auth::user()->can('download_sales_petty_report')) {

            $obj = new GenerateSalesAndPettyCashReport($branch_id, base64_decode($date));
            return $obj->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function downloadByBranchMonthWiseReport($month, $year)
    {
        if (Auth::user()->can('download_petty_cash_by_branch_report')) {
            $obj = new GenerateReportByBranchMonthWise(base64_decode($month), base64_decode($year));
            return $obj->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function downloadSingleBranchMonthlyReport($branch_id, $year)
    {
        if (Auth::user()->can('download_petty_cash_by_month_report')) {
            $obj = new GenerateSingleBranchMonthlyReport(base64_decode($branch_id), base64_decode($year));
            return $obj->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function SalesAndPetty()
    {

        if (Auth::user()->can('sales_petty_cash_tab_management')) {

            $branches = Branch::where("status", 1)->get();

            $daily_petty_expense_report = DailyPettyExpense::whereDate('report_date', date('Y-m-d'))->where('branch_id', $branches[0]['id'])
                ->orderBy('report_date', 'DESC')
                ->orderBy('id', 'DESC')
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->report_date)->format('Y-m-d');
                });

            $selected_branch = $branches[0]->id;
            $selected_date = date('Y-m-d');
            $last_received_amounts = DailyPettyExpenseBalance::where(['branch_id' => $selected_branch])->where('cash_received', '!=', 0)->orderBy('report_date', 'DESC')->orderBy('id', 'DESC')->limit(5)->get();
            $cash_received_by = MdDropdown::where('slug', DailyPettyExpenseBalance::CASH_RECEIVED_BY)->get();

            Session::put('branch_id', $branches[0]->id);

            return view(
                "report.daily-reports.petty-cash-report.sales-and-petty",
                compact("daily_petty_expense_report", "branches", 'selected_branch', 'last_received_amounts', 'selected_date', 'cash_received_by')
            );
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }


    //Start Download Pdf Coding.................
    public function DownloadAllDailyPettyPDF(Request $request){

           
                  //Leave Start Date 
        $date=str_replace("/","-",$request->date);
       // dump($start_leave_date);
        $date =date('Y-m-d',strtotime($date));
              // $date  = date('Y-d-m', strtotime($request->date)); 
              $branch_id = $request->branch_id;
              $imageUrl = $request->imageUrl;

           $daily_petty_expense_reports = DailyPettyExpense::with('docs')->whereDate('report_date', $date)->where('branch_id', $branch_id)
            ->orderBy('report_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->get();

          
            // $datas = DailyPettyExpense::where('branch_id', $branch_id)
            //     ->where('report_type', DailyPettyExpense::VOUCHER)
            //     ->where('report_date', base64_decode($date))
            //     ->orderBy('report_date', 'DESC')
            //     ->orderBy('id', 'DESC')
            //     ->get();

            // $branch = Branch::find($branch_id);
 


           

         //  dd($daily_petty_expense_reports);
           $branch = Branch::find($branch_id);

          $pdf = \PDF::loadView('daily_petty_expense_pdf',compact('daily_petty_expense_reports','branch','date','imageUrl'))->setPaper(array(0, 0, 612, 792), 'landscape');

          return $pdf->download('Daily-Petty-Expense-' . $branch->short_name . '-' . date('d-m-Y', strtotime($date)) . '.pdf');


    }
    //End Download Pdf Coding...................

    public function getMonthlyExpense(Request $request)
    {
        try {
            $expense = DailyPettyExpenseBalance::where('branch_id', Session::get('branch_id'))->whereYear('report_date', $request->year)->whereMonth('report_date', $request->month)->sum('cash_expense');

            return response()->json([
                'status' => true,
                'expense' => number_format($expense, 3, '.', ''),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }
    }

    public function setSearchSession(Request $request)
    {
        if ($request->type == 'branch_id') {
            Session::put('branch_id', $request->param);
        } else {
            Session::put('date', $request->param);
        }

        if ($request->type == 'reset') {
            Session::forget('branch_id');
            Session::forget('date');
        }
    }

    public function downloadPettyCashVoucher($report_date, $branch_id)
    {
        try {
            $datas = DailyPettyExpense::where('branch_id', $branch_id)
                ->where('report_type', DailyPettyExpense::VOUCHER)
                ->where('report_date', base64_decode($report_date))
                ->orderBy('report_date', 'DESC')
                ->orderBy('id', 'DESC')
                ->get();

            $branch = Branch::find($branch_id);

            $pdf = \PDF::loadView('invoice-preview', compact('datas'))->setPaper(array(0, 0, 612, 792), 'landscape');
            return $pdf->download('Petty-Cash-Voucher-' . $branch->short_name . '-' . date('d-m-Y', strtotime(base64_decode($report_date))) . '.pdf');

        } catch (\Exception $e) {
            return $e->getMessage() . ' on line no. ' . $e->getLine() . ' in file ' . $e->getFile();
        }
        return base64_decode($report_date);
    }

    public function downloadPettyCashVoucherNew($report_id)
    {

        try {
            $datas = DailyPettyExpense::where('id', $report_id)->get();
            $branch = Branch::find(Session::get('branch_id'));

            $pdf = \PDF::loadView('invoice-preview', compact('datas'))->setPaper(array(0, 0, 612, 792), 'landscape');
            return $pdf->download('Petty-Cash-Voucher-' . $branch->short_name . '-' . date('d-m-Y', strtotime($datas[0]->report_date)) . '.pdf');

        } catch (\Exception $e) {
            return $e->getMessage() . ' on line no. ' . $e->getLine() . ' in file ' . $e->getFile();
        }
        return base64_decode($report_date);

    }

    public function EditSalesAndPetty($id, $report_type)
    {
        $id = base64_decode($id);
        $report_type = base64_decode($report_type);

        if ($report_type == DailyPettyExpense::NORMAL) {

            $petty_expense = DailyPettyExpense::find($id);

            $petrolpumps = \App\Models\PetrolPumps::where('status', '1')->get();
            $drivers = \App\Models\BranchDriver::where([
                'status' => \App\Models\BranchDriver::ACTIVE,
                'branch_id' => $petty_expense->branch_id,
            ])->get();

            $branch_cars = \App\Models\BranchCar::where('branch_id', $petty_expense->branch_id)->where('status', BranchCar::ACTIVE)->get();

            $categories = DailyPettyExpenseCategory::where('status', 1)->get();
            $petty_docs = DailyPettyExpenseDoc::where('daily_petty_expense_id', $petty_expense->id)->get()->toArray();

            return view('report.daily-reports.petty-cash-report.edit-sales-and-petty')->with([
                'categories' => $categories,
                'petty_expense' => $petty_expense,
                'petty_docs' => $petty_docs,
                'petrolpumps' => $petrolpumps,
                'drivers' => $drivers,
                'branch_cars' => $branch_cars,
            ]);
        } else {

            $petty_expense = DailyPettyExpense::find($id);

            $drivers = \App\Models\BranchDriver::where([
                'status' => \App\Models\BranchDriver::ACTIVE,
                'branch_id' => $petty_expense->branch_id,
            ])->get();

            $branch_cars = \App\Models\BranchCar::where('branch_id', $petty_expense->branch_id)->where('status', BranchCar::ACTIVE)->get();

             $petrolpumps = \App\Models\PetrolPumps::where('status', '1')->get();

            $categories = DailyPettyExpenseCategory::where('status', 1)->get();
            $petty_docs = DailyPettyExpenseDoc::where('daily_petty_expense_id', $petty_expense->id)->get()->toArray();

            return view('report.daily-reports.petty-cash-report.edit_petty_voucher')->with([
                'categories' => $categories,
                'petty_expense' => $petty_expense,
                'petty_docs' => $petty_docs,
                'petrolpumps'=>$petrolpumps,
                'drivers' => $drivers,
                'branch_cars' => $branch_cars,
            ]);
        }

    }

    public function ViewSalesAndPetty($id, $report_type)
    {
        $id = base64_decode($id);
        $report_type = base64_decode($report_type);

        if ($report_type == DailyPettyExpense::NORMAL) {

            $petty_expense = DailyPettyExpense::find($id);

            $petrolpumps = \App\Models\PetrolPumps::where('status', '1')->get();
            $drivers = \App\Models\BranchDriver::where([
                'status' => \App\Models\BranchDriver::ACTIVE,
                'branch_id' => $petty_expense->branch_id,
            ])->get();

            $branch_cars = \App\Models\BranchCar::where('branch_id', $petty_expense->branch_id)->where('status', BranchCar::ACTIVE)->get();

            $categories = DailyPettyExpenseCategory::where('status', 1)->get();
            $petty_docs = DailyPettyExpenseDoc::where('daily_petty_expense_id', $petty_expense->id)->get()->toArray();

            return view('report.daily-reports.petty-cash-report.view-sales-and-petty')->with([
                'categories' => $categories,
                'petty_expense' => $petty_expense,
                'petty_docs' => $petty_docs,
                'petrolpumps' => $petrolpumps,
                'drivers' => $drivers,
                'branch_cars' => $branch_cars,
            ]);
        } else {

            $petty_expense = DailyPettyExpense::find($id);

            $drivers = \App\Models\BranchDriver::where([
                'status' => \App\Models\BranchDriver::ACTIVE,
                'branch_id' => $petty_expense->branch_id,
            ])->get();

            $branch_cars = \App\Models\BranchCar::where('branch_id', $petty_expense->branch_id)->where('status', BranchCar::ACTIVE)->get();

            $categories = DailyPettyExpenseCategory::where('status', 1)->get();
            $petty_docs = DailyPettyExpenseDoc::where('daily_petty_expense_id', $petty_expense->id)->get()->toArray();

            return view('report.daily-reports.petty-cash-report.view_petty_voucher')->with([
                'categories' => $categories,
                'petty_expense' => $petty_expense,
                'petty_docs' => $petty_docs,
                'drivers' => $drivers,
                'branch_cars' => $branch_cars,
            ]);
        }

    }

    public function PreviewDocSalesAndPetty(Request $request)
    {
        //   dd($request->all());
        $petty_docs = DailyPettyExpenseDoc::where('daily_petty_expense_id', $request->id)->get()->toArray();
        $petty_docs_img_count = DailyPettyExpenseDoc::where('daily_petty_expense_id', $request->id)->get('doc')->count();

        $result_view = view("report.daily-reports.petty-cash-report.doc_preview", [
            "petty_docs" => $petty_docs,
            "petty_docs_img_count" => $petty_docs_img_count,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);
    }

    public function checkDuplicateVoucher(Request $request)
    {
        if ($request->has('id')) {
            $expense = DailyPettyExpense::where('voucher_number', $request->voucher_number)->where('id', '!=', $request->id)->first();
        } else {
            $expense = DailyPettyExpense::where('voucher_number', $request->voucher_number)->first();
        }
        if ($expense) {
           // return 'false';
            return response()->json(['status' => 'true', 'msg' => 'Voucher Number already exists']);
        } else {
           // return 'true';
            return response()->json(['status' => 'false', 'msg' => '']);
        }

    }

    public function checkfueltime(Request $request)
    {
        $date = str_replace("/", "-", $request->report_date);
        $reportdate = date('Y-m-d', strtotime($date));
        $expense = DailyPettyExpense::find($request->petty_expense_id);

        $data = DailyPettyExpense::where(['fuel_time' => $request->vehicle_fuel_time,])
        ->where('id', "!=" , $expense->id )
        ->whereDate('report_date', $reportdate)
        ->get();

        if(count($data)>0){
            return response()->json(['msg' => 'true']);
        } else {
            return response()->json(['msg' => 'false']);
        }
    }

    public function updateSalesAndPetty(Request $request)
    {

        $petty_expense = DailyPettyExpense::find($request->id);

        $report_date = str_replace("/", "-", $request->report_date);
        $report_date = date('Y-m-d', strtotime($report_date));

        $petty_expense->amount = number_format($request->amount, 3, '.', '');
        $petty_expense->category_id = $request->category;
        $petty_expense->sub_category_id = $request->sub_category;
        $petty_expense->voucher_number = $request->voucher_number;
        $petty_expense->doc_ref_no = $request->doc_ref_no;
        $petty_expense->remarks = $request->remarks;
        $petty_expense->report_date = $report_date;
        $petty_expense->description = $request->description;

        if ($request->fuel_flag == 1 || $request->fuel_flag == '1') {

            $petrol_slip = str_replace("/", "-", $request->vehicle_petrtol_slip);
            $petrol_slip_date = date('Y-m-d', strtotime($petrol_slip));

            $petty_expense->car_id = $request->vehicle_number;
            $petty_expense->driver_id = $request->driver_id;
            $petty_expense->driven_km = $request->driven_km;
            $petty_expense->fuel = $request->fuel;

            $petty_expense->petrol_pump_id = $request->vehicle_fuel_pump;
            $petty_expense->fuel_time = $request->vehicle_fuel_time;

            $petty_expense->petrol_slip_date = $petrol_slip_date;

        } elseif (($request->repair_flag == 1 || $request->repair_flag == '1' && ($request->fuel_flag != 1 || $request->fuel_flag != '1'))) {
            $petty_expense->car_id = $request->vehicle_number;
            $petty_expense->driver_id = $request->driver_id;
            $petty_expense->driven_km = null;
            $petty_expense->fuel = null;
            $petty_expense->petrol_pump_id = null;
            $petty_expense->fuel_time = null;
            $petty_expense->petrol_slip_date = null;
        } else {
            $petty_expense->car_id = null;
            $petty_expense->driver_id = null;
            $petty_expense->driven_km = null;
            $petty_expense->fuel = null;
            $petty_expense->petrol_pump_id = null;
            $petty_expense->fuel_time = null;
            $petty_expense->petrol_slip_date = null;
        }

        if ($request->cylinder_flag == 1 || $request->cylinder_flag == '1') {
            $petty_expense->number_cylinder = $request->number_cylinder;
            $petty_expense->cylinder_amount = $request->cylinder_amount;
            $petty_expense->cylinder_commission = $request->cylinder_commission;
            $petty_expense->totol_amount = $request->total_amount;
        } else {
            $petty_expense->number_cylinder = null;
            $petty_expense->cylinder_amount = null;
            $petty_expense->cylinder_commission = null;
            $petty_expense->totol_amount = null;
        }

        if ($petty_expense->save()) {

            DailyPettyExpenseBalance::expenseAmountUpdated($petty_expense->id);

            $petty_expense->docs->each(function ($obj) {
                $obj->delete();
            });

            $old_images_old = explode("--", $request->old_images_name);
            for ($i = 0; $i < count(explode("--", $request->old_images_name)) - 1; $i++) {
                $petty_docs = DailyPettyExpenseDoc::create([
                    'daily_petty_expense_id' => $request->id,
                    'doc' => $old_images_old[$i],
                ]);
            }
        }

        Session::put('daily_petty_expense_id', $request->id);
        return "success";
    }

    public function updatePettyVoucher(Request $request)
    {
        Log::info('Admin petty cash voucher ');
        Log::info(['request' => $request]);

        $petty_expense = DailyPettyExpense::find($request->id);

        $report_date = str_replace("/", "-", $request->report_date);
        $report_date = date('Y-m-d', strtotime($report_date));

        $petty_expense->amount = number_format($request->amount, 3, '.', '');
        $petty_expense->category_id = $request->category;
        $petty_expense->sub_category_id = $request->sub_category;
        $petty_expense->doc_ref_no = $request->doc_ref_no;
        $petty_expense->remarks = $request->remarks;
        $petty_expense->report_date = $report_date;
        $petty_expense->person_name = $request->person_name;
        $petty_expense->description = $request->description;
        $petty_expense->voucher_number = $request->invoice_number?$request->invoice_number:null;

        
         if($request->fuel_flag==1 || $request->fuel_flag=='1'){
            $petrol_slip = str_replace("/","-",$request->vehicle_petrtol_slip);
            $petrol_slip_date =date('Y-m-d',strtotime($petrol_slip));

            $petty_expense->car_id = $request->vehicle_number;
            $petty_expense->driver_id = $request->driver_id;
            $petty_expense->driven_km = $request->driven_km;
            $petty_expense->fuel = $request->fuel;

            $petty_expense->petrol_pump_id = $request->vehicle_fuel_pump;
            $petty_expense->fuel_time = $request->vehicle_fuel_time;

            $petty_expense->petrol_slip_date=$petrol_slip_date;

        }elseif(($request->repair_flag==1 || $request->repair_flag=='1' && ($request->fuel_flag!=1 || $request->fuel_flag!='1'))){
            $petty_expense->car_id = $request->vehicle_number;
            $petty_expense->driver_id = $request->driver_id;
            $petty_expense->driven_km = null;
            $petty_expense->fuel = null;
            $petty_expense->petrol_pump_id = null;
            $petty_expense->fuel_time =null;
            $petty_expense->petrol_slip_date=null;
        }else{
            $petty_expense->car_id = null;
            $petty_expense->driver_id = null;
            $petty_expense->driven_km = null;
            $petty_expense->fuel = null;
            $petty_expense->petrol_pump_id = null;
            $petty_expense->fuel_time = null;
            $petty_expense->petrol_slip_date=null;
        }        
        
        if ($request->cylinder_flag == 1 || $request->cylinder_flag == '1') {
            $petty_expense->number_cylinder = $request->number_cylinder;
            $petty_expense->cylinder_amount = $request->cylinder_amount;
            $petty_expense->cylinder_commission = $request->cylinder_commission;
            $petty_expense->totol_amount = $request->total_amount;
        } else {
            $petty_expense->number_cylinder = null;
            $petty_expense->cylinder_amount = null;
            $petty_expense->cylinder_commission = null;
            $petty_expense->totol_amount = null;
        }

        if ($petty_expense->save()) {
            DailyPettyExpenseBalance::expenseAmountUpdated($petty_expense->id);
        }
        
        return redirect()->route('sales-and-petty');
    }

    public function updatePettyDocs(Request $request)
    {
        // dd(env('BRANCH_PORTAL_PETTY_DOC_PATH'));
        $proimages = $request->file('file');

        for ($i = 0; $i < count($proimages); $i++) {

            $image_path = $proimages[$i]->getClientOriginalName();
            $proimages[$i]->move(env('BRANCH_PORTAL_PETTY_DOC_PATH'), $image_path);

            DailyPettyExpenseDoc::create([
                'daily_petty_expense_id' => Session::get('daily_petty_expense_id'),
                'doc' => $image_path,
            ]);
        }
    }

    public function SalesAndPettyDelete(Request $request)
    {

        $daily_petty_expense = DailyPettyExpense::where('id', $request->id)->first();
        $expense_balance = \App\Models\DailyPettyExpenseBalance::where('daily_petty_cash_id', $request->id)->first();

        $daily_petty_expense->docs->each(function ($doc) {
            $doc->delete();
        });

        if ($daily_petty_expense->delete()) {

            DailyPettyExpense::updateBalanceEntriesOnDelete($expense_balance->id);

            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function filterPettyReports(Request $request)
    {
        $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();

        // if ($request->filter_type == 'reset') {
        //     $reports = DailyPettyExpense::where('branch_id', $request->branch_id)->orderBy('report_date', 'DESC')->get();
        // } else {
        //     if (count($request->date_range) > 1) {
        //         $date_range = $request->date_range;
        //         $lower_date = date('Y-m-d', strtotime(str_replace("/", "-", $date_range[0])));
        //         $higher_date = date('Y-m-d', strtotime(str_replace("/", "-", $date_range[1])));

        //         $reports = DailyPettyExpense::where('branch_id', $request->branch_id)->where('report_date', '>=', $lower_date)->where('report_date', '<=', $higher_date)->orderBy('report_date', 'DESC')->get();
        //     } else {
        //         $reports = DailyPettyExpense::where('branch_id', $request->branch_id)->orderBy('report_date', 'DESC')->get();
        //     }
        // }

        $date_range = $request->date_range;
        $lower_date = date('Y-m-d', strtotime(str_replace("/", "-", $date_range[0])));
        $higher_date = date('Y-m-d', strtotime(str_replace("/", "-", $date_range[1])));

        $reports = DailyPettyExpense::where('branch_id', $request->branch_id)->where('report_date', '>=', $lower_date)->where('report_date', '<=', $higher_date)->orderBy('report_date', 'DESC')->get();

        //Filter MkS
        if ($request->from_filter != 'reset') {
            Session::put('petty_cash_report_branch_start_date', $lower_date);
            Session::put('petty_cash_report_branch_end_date', $higher_date);
            Session::put('petty_cash_report_branch_branch_id', $request->branch_id);
        } else {
            Session::put('petty_cash_report_branch_start_date', null);
            Session::put('petty_cash_report_branch_end_date', null);
            Session::put('petty_cash_report_branch_branch_id', null);

        }

        $html = view('report.daily-reports.petty-cash-report.partial')->with([
            'categories' => $categories,
            'reports' => $reports,
        ])->render();

        return json_encode(["html" => $html, "status" => true]);
    }

    public function filterSalesAndPetty(Request $request)
    {
        $date = str_replace("/", "-", $request->date);
        $request_date = date('Y-m-d', strtotime($date));

        //Filter MkS
        if ($request->from_filter != 'reset') {
            Session::put('sales_and_petty_r_start_date', $request_date);
            Session::put('sales_and_petty_r_branch_id', $request->branch_id);
        } else {
            Session::put('sales_and_petty_r_start_date', null);
            Session::put('sales_and_petty_r_branch_id', null);

        }

        $daily_petty_expense_report = DailyPettyExpense::whereDate('report_date', $request_date)->where('branch_id', $request->branch_id)
            ->orderBy('report_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->report_date)->format('Y-m-d');
            });

        $last_received_amounts = DailyPettyExpenseBalance::where(['branch_id' => $request->branch_id])->where('cash_received', '!=', 0)->orderBy('report_date', 'DESC')->orderBy('id', 'DESC')->limit(5)->get();
        $cash_received_by = MdDropdown::where('slug', DailyPettyExpenseBalance::CASH_RECEIVED_BY)->get();

        $closing_balance = view("report.daily-reports.petty-cash-report.closing_balance_partial", [
            "selected_branch" => $request->branch_id,
            "selected_date" => $request_date,
            "last_received_amounts" => $last_received_amounts,
            "cash_received_by" => $cash_received_by,
        ])->render();

        $result_view = view("report.daily-reports.petty-cash-report.sales-and-petty-partial", [
            "daily_petty_expense_report" => $daily_petty_expense_report,
            "selected_branch" => $request->branch_id,
        ])->render();

        return json_encode([
            "html" => $result_view,
            "closing_balance" => $closing_balance,
            "status" => true,
        ]);
    }

    public function addReceivedAmount(Request $request)
    {

        try {
            if ($request->id) {
                $received_balance = DailyPettyExpenseBalance::find($request->id);

                $new_amount = number_format($received_balance->petty_cash_closing_balance, 3, '.', '') + number_format($request->received_amount, 3, '.', '') - number_format($received_balance->cash_received, 3, '.', '');

                $received_balance->update([
                    'cash_received' => number_format($request->received_amount, 3, '.', ''),
                    'petty_cash_closing_balance' => $new_amount,
                    'cash_received_by' => $request->cash_received_by,
                    'cheque_number' => $request->cash_received_by == DailyPettyExpenseBalance::CASH ? null : $request->cheque_number,
                ]);

                DailyPettyExpenseBalance::updateEntries($received_balance->id, $request->branch_id);

            } else {

                DailyPettyExpenseBalance::create([
                    'branch_id' => $request->branch_id,
                    'daily_petty_cash_id' => null,
                    'petty_cash_opening_balance' => DailyPettyExpense::closingBalance($request->branch_id, date('Y-m-d')),
                    'cash_received' => number_format($request->received_amount, 3, '.', ''),
                    'cash_expense' => 0.000,
                    'petty_cash_closing_balance' => DailyPettyExpense::closingBalance($request->branch_id, date('Y-m-d')) + number_format($request->received_amount, 3, '.', ''),
                    'cash_received_by' => $request->cash_received_by,
                    'cheque_number' => $request->cash_received_by == DailyPettyExpenseBalance::CASH ? null : $request->cheque_number,
                    'doc_ref_no' => null,
                    'report_date' => date('Y-m-d'),
                ]);
            }

            $last_received_amounts = DailyPettyExpenseBalance::where(['branch_id' => $request->branch_id])->where('cash_received', '!=', 0)->orderBy('report_date', 'DESC')->orderBy('id', 'DESC')->limit(5)->get();

            $cash_received_by = MdDropdown::where('slug', DailyPettyExpenseBalance::CASH_RECEIVED_BY)->get();

            $result_view = view("report.daily-reports.petty-cash-report.closing_balance_partial", [
                "selected_branch" => $request->branch_id,
                "selected_date" => date('Y-m-d'),
                "last_received_amounts" => $last_received_amounts,
                "cash_received_by" => $cash_received_by,
            ])->render();

            return response()->json([
                'status' => true,
                'html' => $result_view,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }

        return redirect()->back();
    }

    public function deletedSalesAndPettyReportList()
    {
        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');
        $allBranchDeletedReports = DailyPettyExpense::with('Branch')->onlyTrashed()->get();
        return view('report.daily-reports.petty-cash-report.petty-cash-restore.deleted_list', compact('branch', 'allBranchDeletedReports'));
    }

    public function filterSalesAndPettyDeletedReports(Request $request)
    {
        $allBranchDeletedReports = null;
        if ($request->with == 'only_branch_id') {

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = DailyPettyExpense::with('Branch')->onlyTrashed()->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = DailyPettyExpense::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->get();
            }

            $result_view = view('report.daily-reports.petty-cash-report.petty-cash-restore.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

        if ($request->with == "apply_filter") {

            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = DailyPettyExpense::with('Branch')->onlyTrashed()->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = DailyPettyExpense::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            $result_view = view('report.daily-reports.petty-cash-report.petty-cash-restore.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);
        }
    }

    public function resetSalesAndPettyDeletedReports(Request $request)
    {
        $allBranchDeletedReports = DailyPettyExpense::with('Branch')->onlyTrashed()->get();
        $result_view = view('report.daily-reports.petty-cash-report.petty-cash-restore.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();
        return json_encode(['html' => $result_view, 'status' => true]);
    }

    public function restoreSalesAndPettyReport(Request $request)
    {
        $selected_dates = DailyPettyExpense::withTrashed()->where('id', $request->id)->restore();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function permanentDeleteSalesAndPettyReport(Request $request)
    {
        $selected_dates = DailyPettyExpense::withTrashed()->where('id', $request->id)->forceDelete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    // petty cash report by branch month wise
    public function pettyCashByBranchMonthWise()
    {
        if (Auth::user()->can('by_branch_month_wise_tab_management')) {

            $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
            $branches = Branch::where("status", Branch::ACTIVE)->get();
            $reports = DailyPettyExpense::whereMonth('report_date', date('m'))->whereYear('report_date', date('Y'));

            $html = '';
            foreach ($branches as $branch) {

                $monthAmountCheck = DailyPettyExpense::checkSingleBranchAmountExist($branch, date('m'), date('Y'));
                if ($monthAmountCheck > 0) {
                    $html .= '<tr>';
                    $html .= '<td class="table_th" style="white-space: nowrap;padding:10px">' . $branch['short_name'] . '</td>';
                    $html .= '<td class="table_th" style="white-space: nowrap;padding:10px">' . number_format($monthAmountCheck, 3) . '</td>';
                    foreach ($categories as $category) {
                        foreach ($category->subcategories as $subcategory) {
                            $val = DailyPettyExpense::getExpenseBranchMonthWise($subcategory, $branch, date('m'), date('Y'));
                            $html .= '<td class="table_th" style="white-space: nowrap">' . ($val == 0 ? '-' : number_format($val, 3)) . '</td>';
                        }
                    }
                    $html .= '</tr>';
                }
            }

            return view(
                "report.daily-reports.petty-cash-report.branch-month-wise",
                compact("categories", "reports", 'html')
            );

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function getSubCategories(Request $request)
    {
        $sub_categories = DailyPettyExpenseSubCategory::where('category_id', $request->cat_id)->get();
        return response()->json([
            'sub_categories' => $sub_categories,
            "status" => true,
        ]);
    }

    public function pettyCashByBranchMonthWiseFilter(Request $request)
    {
        try {
            if ($request->has('reset') && $request->reset != null && $request->reset != '') {
                $month = date('m');
                $year = date('Y');
            } else {
                $month = $request->month;
                $year = $request->year;
            }

            //Start filter prevent.....

            if ($request->reset != 'reset') {
                Session::put('petty_cash_report_by_branch_month_wise_month', $month);
                Session::put('petty_cash_report_by_branch_month_wise_year', $year);
            } else {
                Session::put('petty_cash_report_by_branch_month_wise_month', null);
                Session::put('petty_cash_report_by_branch_month_wise_year', null);

            }

            //End Filter  prevent.....

            $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
            $all_active_branches = Branch::where("status", 1)->get();

            $html = '';
            foreach ($all_active_branches as $branch) {
                $monthAmountCheck = DailyPettyExpense::checkSingleBranchAmountExist($branch, $month, $year);
                if ($monthAmountCheck > 0) {
                    $html .= '<tr>';
                    $html .= '<td class="table_th" style="white-space: nowrap;padding:10px">' . $branch['short_name'] . '</td>';
                    $html .= '<td class="table_th" style="white-space: nowrap;padding:10px">' . number_format($monthAmountCheck, 3) . '</td>';
                    foreach ($categories as $category) {
                        foreach ($category->subcategories as $subcategory) {
                            $val = DailyPettyExpense::getExpenseBranchMonthWise($subcategory, $branch, $month, $year);
                            $html .= '<td class="table_th" style="white-space: nowrap">' . ($val == 0 ? '-' : number_format($val, 3)) . '</td>';
                        }
                    }
                    $html .= '</tr>';
                }
            }
            return response()->json([
                'status' => true,
                'data' => $html,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }
    }

    public function pettyCashReportSingleBranchMonthly()
    {
        if (Auth::user()->can('by_branch_single_branch_wise_tab_management')) {

            $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
            $all_active_branches = Branch::where("status", 1)->get();

            $html = '';
            for ($i = 12; $i >= 1; $i--) {
                $i = $i < 10 ? '0' . $i : $i;

                $amountCheck = DailyPettyExpense::checkSingleBranchAmountExist($all_active_branches[0], $i, date('Y'));

                if ($amountCheck > 0) {

                    $html .= '<tr>';
                    $html .= '<td class="table_th" style="white-space: nowrap;padding:10px">' . $i . '/' . date('Y') . '</td>';

                    foreach ($categories as $category) {

                        foreach ($category->subcategories as $subcategory) {

                            $val = DailyPettyExpense::getExpenseBranchMonthWise($subcategory, $all_active_branches[0], $i, date('Y'));

                            $html .= '<td class="table_th" style="white-space: nowrap">' . ($val == 0 ? '-' : number_format($val, 3)) . '</td>';
                        }

                    }
                    $html .= '</tr>';
                }

            }

            return view(
                "report.daily-reports.petty-cash-report.single-branch-monthly-report",
                compact("categories", "html", "all_active_branches")
            );
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function pettyCashSingleBranchMonthlyFilter(Request $request)
    {
        try {
            if ($request->has('reset') && $request->reset != null && $request->reset != '') {
                $year = date('Y');
            } else {
                $year = $request->year;
            }

            if ($request->reset != 'reset') {
                Session::put('petty_cash_report_by_month_single_branch_start_year', $year);
                Session::put('petty_cash_report_by_month_single_branch_branch_id', $request->branch_id);
            } else {
                Session::put('petty_cash_report_by_month_single_branch_start_year', null);
                Session::put('petty_cash_report_by_month_single_branch_branch_id', null);

            }

            $categories = DailyPettyExpenseCategory::where(['status' => DailyPettyExpenseCategory::ACTIVE])->get();
            $branch = Branch::find($request->branch_id);
            $html = '';
            for ($i = 12; $i >= 1; $i--) {
                $i = $i < 10 ? '0' . $i : $i;

                $amountMonthCheck = DailyPettyExpense::checkSingleBranchAmountExist($branch, $i, date('Y'));

                if ($amountMonthCheck > 0) {
                    $html .= '<tr>';
                    $html .= '<td class="table_th" style="white-space: nowrap;padding:10px">' . $i . '/' . $year . '</td>';
                    foreach ($categories as $category) {
                        foreach ($category->subcategories as $subcategory) {
                            $val = DailyPettyExpense::getExpenseBranchMonthWise($subcategory, $branch, $i, $year);
                            $html .= '<td class="table_th" style="white-space: nowrap">' . ($val == 0 ? '-' : number_format($val, 3)) . '</td>';
                        }
                    }
                    $html .= '</tr>';
                }
            }
            return response()->json([
                'status' => true,
                'data' => $html,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }
    }

    public function resetPettyFilteredReports(Request $request)
    {
        $daily_petty_expense_report = DailyPettyExpense::orderByDesc("created_at")->get();

        $result_view = view("report.daily-reports.petty-cash-report.partial", [
            "daily_petty_expense_report" => $daily_petty_expense_report,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);
    }

    public function BranchOfficeDetailList()
    {
        return view(
            "report.online-platform-reports.branch-office-details-report.index"
        );
    }

    public function BranchOfficeDetailReportView()
    {
        return "view";
    }

    public function BranchOfficeDetailReportDownload()
    {
        return "download";
    }

    public function DetailedAllBranchReportList()
    {
        return view(
            "report.online-platform-reports.detailed-all-branch-report.index"
        );
    }

    public function DetailedAllBranchReportView()
    {
        return "view";
    }

    public function DetailedAllBranchReportDownload()
    {
        return "download";
    }

    public function ItemWiseSalesReportList()
    {
        return view(
            "report.online-platform-reports.item-wise-sales-report.index"
        );
    }

    public function ItemWiseSalesReportView()
    {
        return "view";
    }

    public function ItemWiseSalesReportDownload()
    {
        return "download";
    }

    public function OrderDetailsPart1ReportList()
    {
        return view(
            "report.online-platform-reports.order-details-part-1-1-report.index"
        );
    }

    public function OrderDetailsPart1ReportView()
    {
        return "view";
    }

    public function OrderDetailsPart1ReportDownload()
    {
        return "download";
    }

    public function OrderEndOfDayPart2ReportList()
    {
        return view(
            "report.online-platform-reports.order-end-of-day-part-2-report.index"
        );
    }

    public function OrderEndOfDayPart2ReportView()
    {
        return "view";
    }

    public function OrderEndOfDayPart2ReportDownload()
    {
        return "download";
    }

    public function OrderDetailsByHourReportList()
    {
        return view(
            "report.online-platform-reports.order-details-by-hour-report.index"
        );
    }

    public function OrderDetailsByHourReportView()
    {
        return "view";
    }

    public function OrderDetailsByHourReportDownload()
    {
        return "download";
    }

    public function OrderDetailsByAreaReportList()
    {
        return view(
            "report.online-platform-reports.order-details-by-area-report.index"
        );
    }

    public function OrderDetailsByAreaReportView()
    {
        return "view";
    }

    public function OrderDetailsByAreaReportDownload()
    {
        return "download";
    }

    public function OrderRejectionReportList()
    {
        return view(
            "report.online-platform-reports.order-rejection-report.index"
        );
    }

    public function OrderRejectionReportView()
    {
        return "view";
    }

    public function OrderRejectionReportDownload()
    {
        return "download";
    }

    public function OrderPrepartionTimeReportList()
    {
        return view(
            "report.online-platform-reports.order-prepartion-time-report.index"
        );
    }

    public function OrderPrepartionTimeReportView()
    {
        return "view";
    }

    public function OrderPrepartionTimeReportDownload()
    {
        return "download";
    }

    public function createDateRangeArray($start, $end)
    {
        $range = array();
        if (is_string($start) === true) {
            $start = strtotime($start);
        }

        if (is_string($end) === true) {
            $end = strtotime($end);
        }

        if ($start > $end) {
            return createDateRangeArray($end, $start);
        }

        do {
            $range[] = date('d-M-Y', $start);
            $start = strtotime("+ 1 day", $start);
        } while ($start <= $end);

        return array_reverse($range);
    }

    public function createDateRangeArray_2($start, $end)
    {
        $range = array();
        if (is_string($start) === true) {
            $start = strtotime($start);
        }

        if (is_string($end) === true) {
            $end = strtotime($end);
        }

        if ($start > $end) {
            return createDateRangeArray($end, $start);
        }

        do {
            $range[] = date('Y-m-d', $start);
            $start = strtotime("+ 1 day", $start);
        } while ($start <= $end);

        return $range;
    }

    public function deleteBranchReport(Request $request)
    {
        try {

            $report = DailyPettyExpense::find($request->id);
            $expense_balance = \App\Models\DailyPettyExpenseBalance::where('daily_petty_cash_id', $request->id)->first();

            $report->docs->each(function ($doc) {
                $doc->delete();
            });

            if ($report->delete()) {

                DailyPettyExpense::updateBalanceEntriesOnDelete($expense_balance->id);

                return response()->json([
                    'status' => true,
                    'message' => 'Report deleted successfully!',
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'something went wrong',
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }
    }

    public function editcheckKM(Request $request)
    {

        $car_last_data = DailyPettyExpense::where(['car_id' => $request->vehicle_number])->where('id', "!=", $request->id)->orderby('id', 'DESC')->first();

        if ($car_last_data) {
            if ($request->driven_km > $car_last_data->driven_km) {
                return response()->json(['status' => 'false', 'msg' => '']);
            } else {
                return response()->json(['status' => 'true', 'msg' => 'Driven KM more than ' . $car_last_data->driven_km]);
            }
        } else {

            return response()->json(['status' => 'false', 'msg' => '']);
        }

    }

}
