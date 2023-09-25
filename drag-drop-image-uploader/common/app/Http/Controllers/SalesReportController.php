<?php
namespace App\Http\Controllers;

use App\Http\Reports\salesreport\BranchNetSales;
use App\Http\Reports\salesreport\BranchSales;
use App\Http\Reports\salesreport\CashDeposit;
use App\Http\Reports\salesreport\DailySalesReportDSR;
use App\Http\Reports\salesreport\DiscountSalesdownload;
use App\Http\Reports\salesreport\GrossSalesMonthlydownload;
use App\Http\Reports\salesreport\NetSalesMonthlydownload;
use App\Http\Reports\salesreport\Monthsales;
use App\Http\Reports\salesreport\PaymentMethod;
use App\Http\Reports\salesreport\SalesServiceReport;
use App\Http\Reports\salesreport\DiscountComplimentReturndownload;
use App\Models\Branch;
use App\Models\DailySaleReport;
use App\Models\DailySaleReportDoc;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Session;

class SalesReportController extends Controller
{

    public function cashlist()
    {

        if (Auth::user()->can('cash_deposite_tab_management')) {
            $current_month = Carbon::now('m');
            $current_year = Carbon::now('Y');

            $monthdeposit = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
                , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'))
                ->whereMonth('report_date', $current_month)
                ->whereYear('report_date', $current_year)
                ->groupBy('date', 'branch_id')
                ->get();

            //MK....
            $branch_demo = Branch::where('status', '1')->get()->pluck('id')->toArray();
            $all_total_keys_with_branch = array();
            $sum = 0;
            foreach ($branch_demo as $branch) {

                $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
                    , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'))
                    ->whereMonth('report_date', $current_month)
                    ->whereYear('report_date', $current_year)->where('branch_id', $branch)
                    ->groupBy('date', 'branch_id')
                    ->get()->pluck('cash_deposit_in_bank')->toArray();

                //dd($data);

                $all_total_keys_with_branch += [$branch => array_sum($data)];
                $sum = +$sum + array_sum($data);

            }

            $all_total_keys_with_branch += ['total' => $sum];
            //  dump($all_total_keys_with_branch);

            $branches = Branch::where("status", '1')->get();

            $html_design = '';

            $html_design .= '<tr id="show_total_amt">';
            $html_design .= '<th colspan="2" style="color:green">Total</th>';

            foreach ($all_total_keys_with_branch as $cash_deposite_branch_wise_total) {
                $html_design .= '<th style="color:green">' . ($cash_deposite_branch_wise_total == 0 ? '-' : number_format($cash_deposite_branch_wise_total, 3)) . '</th>';

            }

            $html_design .= '</tr>';

            //MK..........

            $dailymonthdepositbank = array();
            foreach ($monthdeposit as $value_bank) {
                $dailymonthdepositbank[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
            }

            //dd($dailymonthdepositbank);

            $aDates = array();
            $oStart = new DateTime(date('Y-m-01', strtotime(date('Y-m-d'))));
            $oEnd = clone $oStart;
            $oEnd->add(new DateInterval("P1M"));

            while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
                $aDates[] = $oStart->format('d-m-Y');
                $day[] = $oStart->format('D');
                $oStart->add(new DateInterval("P1D"));
            }

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

            // $aDates=array_intersect_key($aDates,array_keys ($dailymonthdepositbank));

            //  dd($aDates);

            return view('report.daily-reports.sales-report.cash_deposit.index', compact('branch', 'dailymonthdepositbank', 'aDates', 'html_design'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function downloadcashdeposit($month = null, $year = null)
    {
        if (Auth::user()->can('download_cash_deposite_branch_wise_report')) {

            $cash = new CashDeposit($month, $year);
            $cash->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function cashdepositfilter(Request $request)
    {
        $current_month = $request->month;
        $current_year = $request->year;

        //Start filter prevent.....

        if ($request->from_filter != 'reset') {
            Session::put('cash_deposite_branch_wise_month', $current_month);
            Session::put('cash_deposite_branch_wise_year', $current_year);
        } else {
            Session::put('cash_deposite_branch_wise_month', null);
            Session::put('cash_deposite_branch_wise_year', null);

        }

        //End Filter  prevent.....

        $monthdeposit = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
            , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'))
            ->whereMonth('report_date', $current_month)
            ->whereYear('report_date', $current_year)
            ->groupBy('date', 'branch_id')
            ->get();

        $dailymonthdepositbank = array();
        foreach ($monthdeposit as $value_bank) {
            $dailymonthdepositbank[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
        }

        $aDates = array();
        $oStart = new DateTime(date('Y-m-01', strtotime($current_year . "-" . $current_month . "-01")));
        $oEnd = clone $oStart;
        $oEnd->add(new DateInterval("P1M"));

        while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
            $aDates[] = $oStart->format('d-m-Y');
            $day[] = $oStart->format('D');
            $oStart->add(new DateInterval("P1D"));
        }

        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');

        // $aDates=array_intersect_key($aDates,array_keys ($dailymonthdepositbank));

        $html = view('report.daily-reports.sales-report.cash_deposit.partial', compact('branch', 'dailymonthdepositbank', 'aDates'))->render();

        //MK....
        $branch_demo = Branch::where('status', '1')->get()->pluck('id')->toArray();
        $all_total_keys_with_branch = array();
        $sum = 0;
        foreach ($branch_demo as $branch) {

            $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
                , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'))
                ->whereMonth('report_date', $current_month)
                ->whereYear('report_date', $current_year)->where('branch_id', $branch)
                ->groupBy('date', 'branch_id')
                ->get()->pluck('cash_deposit_in_bank')->toArray();

            //dd($data);

            $all_total_keys_with_branch += [$branch => array_sum($data)];
            $sum = +$sum + array_sum($data);

        }

        $all_total_keys_with_branch += ['total' => $sum];
        //  dump($all_total_keys_with_branch);

        $branches = Branch::where("status", '1')->get();

        $html_design = '';

        //  $html_design .= '<tr id="show_total_amt">';
        $html_design .= '<th colspan="2" style="color:green">Total</th>';

        foreach ($all_total_keys_with_branch as $cash_deposite_branch_wise_total) {
            $html_design .= '<th style="color:green">' . ($cash_deposite_branch_wise_total == 0 ? '-' : number_format($cash_deposite_branch_wise_total, 3)) . '</th>';

        }

        //   $html_design .= '</tr>';

        //MK..........

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'html_design' => $html_design,

        ]);
    }

    public function SalesReportList()
    {
       
        if (Auth::user()->can('daily_sales_tab_management')) {

            $headerscolumn = array(
                'gross_sale' => 'Gross Sale'
                , 'discount' => 'Discount & Return'
                , 'net_sale' => 'Net Sale'
                , 'cash_in_hand_opening_balance' => 'Opening Balance'
                , 'cash_deposit_in_bank' => 'Cash Deposit'
                , 'cash_in_hand_closing_balance' => 'Closing Balance',
                // ,'dine_in_restaurent'=>'Dine-In Rest'
                // ,'dine_in_cabin'=>'Dine-In Cab'
                // ,'take_away_self_pickup'=>'Self Pickup'
                // ,'home_delivery'=>'H. Delivery'
                // ,'buffet'=>'Buffet',
                // 'talabat_TEM'=>'Tlbt (TMP)',
                // 'talabat_TGO'=>'Tlbt (TGO)',
                // 'MM_Express_TGO'=>'MM Express'
                // ,'deliveroo_TEM'=>'Dlvroo  (TMP)'
                // ,'deliveroo_TGO'=>'Dlvroo (TGO)'
                // ,'v_thru'=>'V-Thru'
                // ,'mm_online'=>'MM Online'
                // ,'osc'=>'Osc'
                // ,'garden'=>'Garden'
                // ,'others_gross'=>'Others'
                //
                // ,'discount'=>'Discount'
                // ,'complimentary'=>'Complimentary'
                // ,'sale_Return'=>'Sale Ret'
                // ,'total_collection'=>'TOTAL'
                // ,'talabat_credit'=>'Credit Tlbt'
                // ,'deliveroo_credit'=>'Credit Dlvroo'
                // ,'v_thru_credit'=>'Credit V-Thru'
                // ,'MMGTC'=>'CR/CARD MMGTC'
                // ,'e_gift_card'=>'Gift Card'
                // ,'cash_shortage'=>'Cash Shrtg'
                //
                // ,'cash_in_hand_actual'=>'Cash Actual'
                //
            );

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');
            $selbranch = Branch::select('short_name', 'id')->get()->first();

            $curMonth = date('F');
            $curYear = date('Y');
            $timestamp = strtotime($curMonth . ' ' . $curYear);
            $first_second = date('Y-m-01 00:00:00', $timestamp);
            $last_second = date('Y-m-t 12:59:59', $timestamp);

            $current_month = Carbon::now('m');
            $current_year = Carbon::now('Y');

            $data = DailySaleReport::where('branch_id', $selbranch->id)->whereBetween('report_date', [$first_second, $last_second])->orderBy('report_date', 'DESC')->get();

            return view('report.daily-reports.sales-report.daily_sales.index', compact('selbranch', 'branch', 'headerscolumn', 'data'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    //Start doc coding.............

    public function doc_upload_save(Request $request)
    {

        $path = env('PATH_TO_UPLOAD_DSR_DOC');
        //$path = $_SERVER['DOCUMENT_ROOT']."/".env('BRANCH_DOC_PROJECT_NAME')."branch_images/";
        // dd($request->all());

        $image = null;

        if ($request->file("uploadFile")) {
            $DSRImage = $request->file("uploadFile");
            $image =
            time() . "." . $DSRImage->getClientOriginalExtension();
            $DSRImage->move($path, $image);
        }

        $dailySalesDoc = new DailySaleReportDoc();
        $dailySalesDoc->branch_id = $request->branch_id;
        $dailySalesDoc->daily_sales_report_id = $request->daily_sales_report_id;
        $dailySalesDoc->invoice_domain = $request->upload_daily_sales_invoice_domain;
        $dailySalesDoc->doc = $image;
        $dailySalesDoc->save();
        return "success";

    }

    public function doc_upload_edit(Request $request)
    {
        $daily_invoice_types = DB::table('md_dropdowns')->where('slug', 'daily_invoice_type')->get();
        $dailySalesDocEdit = DailySaleReportDoc::where('id', $request->id)->first();
        $result_view = view("report.daily-reports.sales-report.daily_sales.doc_edit_partial", [
            "dailySalesDocEdit" => $dailySalesDocEdit, 'daily_invoice_types' => $daily_invoice_types,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function doc_upload_update(Request $request)
    {
        $path = env('PATH_TO_UPLOAD_DSR_DOC');
        $dailySalesDoc = DailySaleReportDoc::where('id', $request->invoice_id)->first();
        $dailySalesDoc->invoice_domain = $request->upload_daily_sales_invoice_domain;
        if ($request->file("uploadFile")) {
            $DSRImage = $request->file("uploadFile");
            $image =
            time() . "." . $DSRImage->getClientOriginalExtension();
            $DSRImage->move($path, $image);
            $dailySalesDoc->doc = $image;
        }

        $dailySalesDoc->save();
        return "success";

    }

    public function delete_doc(Request $request)
    {

        $deleteDoc = DailySaleReportDoc::where("id", $request->id)->delete();
        if ($deleteDoc) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function editRvNumber(Request $request)
    {
        DailySaleReport::where('id', $request->report_id)->first()->update(['rv_number' => $request->rv_number]);
        return response()->json([
            'success' => true,
            'status' => 'true',

        ]);
    }

    public function DownloadPdfDSR($id)
    {

        try {
            $daily_invoice_types = DB::table('md_dropdowns')->where('slug', 'daily_invoice_type')->get();
            $daily_report_sales = DailySaleReport::with('Branch')->where(['id' => $id])->first();
            $daily_sales_report_doc = DailySaleReportDoc::where(['daily_sales_report_id' => $id])->orderby('id', 'DESC')->get();

            $pdf = \PDF::loadView('daily_sales_report_pdf', compact('daily_invoice_types', 'daily_report_sales', 'daily_sales_report_doc'))->setPaper(array(0, 0, 612, 792), 'landscape');

            // return $pdf->download('Petty-Cash-Voucher-' . $branch->short_name . '-' . date('d-m-Y', strtotime($datas[0]->report_date)) . '.pdf');

            return $pdf->download('DailySaleReport' . $daily_report_sales->report_date . "_" . $daily_report_sales->branch->title_en . '.pdf');

        } catch (\Exception $e) {
            return $e->getMessage() . ' on line no. ' . $e->getLine() . ' in file ' . $e->getFile();
        }
        return base64_decode($report_date);

    }


    public function DownloadImageDSR(Request $request){

         $report_date=str_replace("/","-",$request->date);
        
         $report_date =date('Y-m-d',strtotime($report_date));
          
         $branches = Branch::where("status", '1')->get();
         

         $daily_all_branch_DSR = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
                , DB::raw('SUM(gross_sale) as gross_sale') , DB::raw('SUM(discount_return) as discount') , DB::raw('SUM(net_sale) as netsales'))
                ->where('report_date', $report_date) 
                ->whereNull('deleted_at')
                ->groupBy('date', 'branch_id')->orderBY('branch_id')
                ->get(); 

                  
         $result_view = view('report.daily-reports.sales-report.daily_sales.daily_sales_all_branch_image',compact('daily_all_branch_DSR','report_date'))->render();

        return json_encode(['html' => $result_view, 'status' => true]);         
         
    }

    public function getLatestDoc(Request $request)
    {
        $daily_invoice_types = DB::table('md_dropdowns')->where('slug', 'daily_invoice_type')->get();
        $daily_sales_report_doc = DailySaleReportDoc::where(['daily_sales_report_id' => $request->id])->orderby('id', 'DESC')->get();
        $result_view = view('report.daily-reports.sales-report.daily_sales.doc_partial', ['daily_sales_report_doc' => $daily_sales_report_doc, 'daily_invoice_types' => $daily_invoice_types])->render();

        return json_encode(['html' => $result_view, 'status' => true]);

    }

    //End doc coding.............

    public function SalesReportEdit($id)
    {
        if (Auth::user()->can('edit_daily_sales_report')) {

            $daily_invoice_types = DB::table('md_dropdowns')->where('slug', 'daily_invoice_type')->get();

            $daily_report_sales = DailySaleReport::with('Branch')->where(['id' => $id])->first();
            $daily_sales_report_doc = DailySaleReportDoc::where(['daily_sales_report_id' => $id])->orderby('id', 'DESC')->get();
            return view('report.daily-reports.sales-report.daily_sales.edit', compact('daily_report_sales', 'daily_sales_report_doc', 'daily_invoice_types'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

//DSR view start.........

    public function SalesReportView($id)
    {
        // return "Working on it....";
        $daily_invoice_types = DB::table('md_dropdowns')->where('slug', 'daily_invoice_type')->get();

        $daily_report_sales = DailySaleReport::with('Branch')->where(['id' => $id])->first();
        $daily_sales_report_doc = DailySaleReportDoc::where(['daily_sales_report_id' => $id])->orderby('id', 'DESC')->get();
        return view('report.daily-reports.sales-report.daily_sales.view', compact('daily_report_sales', 'daily_sales_report_doc', 'daily_invoice_types'));

    }

//DSR view end...........

    public function SalesReportUpdate(Request $request)
    {
        DailySaleReport::where("id", $request->report_id)
            ->first()
            ->update(["rv_number" => $request->rv_number]);
        return response()->json([
            "success" => true,
            "status" => "true",
        ]);
    }

    public function update_report(Request $request, $id)
    {
        // return $request->all();
        //   $branch_details = User::where('id',Auth::id())->with('branch_manager')->first();

        //   $get_branch_id = Session::get('branch_id');

        //    $branch_id = Branch::where('id',$get_branch_id)->first();

        $Report = DailySaleReport::where('id', $id)->first();

        // $Report->branch_id = $branch_id->id;
        //  $Report->user_id = Auth::id();
        //  $Report->rv_number = $request->rv_number;

        $Report->rv_number = $request->rv_number;
        $Report->gross_sale = $request->gross_sale;
        $Report->dine_in_restaurent = $request->dine_in_restaurent;
        $Report->dine_in_cabin = $request->dine_in_cabin;
        $Report->take_away_self_pickup = $request->take_away_self_pickup;
        $Report->home_delivery = $request->home_delivery;
        $Report->buffet = $request->buffet;
        $Report->talabat_TEM = $request->talabat_TEM;
        $Report->talabat_TGO = $request->talabat_TGO;
        $Report->deliveroo_TEM = $request->deliveroo_TEM;
        $Report->deliveroo_TGO = $request->deliveroo_TGO;
        $Report->v_thru = $request->v_thru;
        $Report->mm_online = $request->mm_online;
        $Report->osc = $request->osc;
        $Report->garden = $request->garden;
        $Report->others_gross = $request->others_gross;
        $Report->discount_return = $request->discount_return;
        $Report->discount = $request->discount;
        //$Report->complimentary = $request->complimentary;
        $Report->complimentary = array_sum(json_decode(json_encode(explode(',', $request->Complimentary))));
        $Report->sale_Return = $request->sale_Return;
        $Report->net_sale = $request->net_sale;
        $Report->cash_in_hand = $request->cash_in_hand;
        $Report->cash_in_hand_actual = $request->cash_in_hand_actual;
        $Report->cash_shortage = $request->cash_shortage;
        $Report->cash_overage = $request->cash_overage;
        $Report->cards_sale = $request->cards_sale;
        $Report->cheque_cash = $request->cheque_cash;
        $Report->credit_sale = $request->credit_sale;
        $Report->total_collection = $request->total_collection;
        $Report->cash_in_hand_opening_balance = $request->cash_in_hand_opening_balance;
        $Report->cash_sales = $request->cash_sales;
        $Report->cash_deposit_in_bank = $request->cash_deposit_in_bank;
        $Report->cash_in_hand_closing_balance = $request->cash_in_hand_closing_balance;
        $Report->MM_Express_TGO = $request->MM_Express_TGO;

        //add count

        $Report->dine_in_restaurant_count = $request->dine_in_restaurant_count;
        $Report->dine_in_cabin_count = $request->dine_in_cabin_count;
        $Report->self_pickup_count = $request->self_pickup_count;
        $Report->home_delivery_count = $request->home_delivery_count;
        $Report->buffet_count = $request->buffet_count;
        $Report->talabat_TEM_count = $request->talabat_TEM_count;
        $Report->talabat_TGO_count = $request->talabat_TGO_count;
        $Report->deliveroo_TEM_count = $request->deliveroo_TEM_count;
        $Report->deliveroo_TGO_count = $request->deliveroo_TGO_count;
        $Report->v_thru_count = $request->v_thru_count;
        $Report->mm_online_count = $request->mm_online_count;
        $Report->osc_count = $request->osc_count;
        $Report->garden_count = $request->garden_count;
        $Report->others_gross_count = $request->others_gross_count;
        $Report->MM_Express_TGO_count = $request->MM_Express_TGO_count;

        $Report->complimentary_name = $request->Complimentary_name != null ? json_encode(explode(',', $request->Complimentary_name)) : null;

        $Report->complimentary_contact = $request->Complimentary_contact != null ? json_encode(explode(',', $request->Complimentary_contact)) : null;

        $Report->complimentary_invoice = $request->Complimentary_invoice != null ? json_encode(explode(',', $request->Complimentary_invoice)) : null;

        $Report->complimentary_amount = $request->Complimentary_amount != null ? json_encode(explode(',', $request->Complimentary_amount)) : null;

        $Report->complimentary_ref = $request->Complimentary_ref != null ? json_encode(explode(',', $request->Complimentary_ref)) : null;

        $Report->amex = $request->amex != null ? json_encode(explode(',', $request->amex)) : null;

        $Report->visa = $request->visa != null ? json_encode(explode(',', $request->visa)) : null;

        $Report->master = $request->master != null ? json_encode(explode(',', $request->master)) : null;

        $Report->dinner = $request->dinner != null ? json_encode(explode(',', $request->dinner)) : null;

        $Report->mm_online_link = $request->mm_online_link != null ? json_encode(explode(',', $request->mm_online_link)) : null;

        $Report->knet = $request->knet != null ? json_encode(explode(',', $request->knet)) : null;

        $Report->other_cards = $request->other_cards != null ? json_encode(explode(',', $request->other_cards)) : null;

        $Report->remarks = $request->remarks != null ? json_encode(explode(',', $request->remarks)) : null;

        //Cheque/Cash Equivalent

        $Report->cheque = $request->cheque != null ? json_encode(explode(',', $request->cheque)) : null;
        $Report->printed_gift_card = $request->printed_gift_card != null ? json_encode(explode(',', $request->printed_gift_card)) : null;
        $Report->e_gift_card = $request->E_gift_card != null ? json_encode(explode(',', $request->E_gift_card)) : null;
        $Report->gift_coupon_voucher = $request->Coupon_gift_card != null ? json_encode(explode(',', $request->Coupon_gift_card)) : null;
        $Report->cash_equivalent = $request->cash_equivalent_card != null ? json_encode(explode(',', $request->cash_equivalent_card)) : null;

        //Credit Sale

        $Report->talabat_credit_TMP = $request->talabat_creditTMP != null ? json_encode(explode(',', $request->talabat_creditTMP)) : null;
        $Report->talabat_credit_TGO = $request->talabat_creditTGO != null ? json_encode(explode(',', $request->talabat_creditTGO)) : null;
        $Report->deliveroo_credit_TMP = $request->deliveroo_creditTMP != null ? json_encode(explode(',', $request->deliveroo_creditTMP)) : null;
        $Report->deliveroo_credit_TGO = $request->deliveroo_creditTGO != null ? json_encode(explode(',', $request->deliveroo_creditTGO)) : null;
        $Report->v_thru_credit_TMP = $request->v_thru_creditTMP != null ? json_encode(explode(',', $request->v_thru_creditTMP)) : null;

        $Report->v_thru_credit_TGO = $request->v_thru_creditTGO != null ? json_encode(explode(',', $request->v_thru_creditTGO)) : null;
        $Report->others_credit_TMP = $request->others_creditTMP != null ? json_encode(explode(',', $request->others_creditTMP)) : null;
        $Report->others_credit_TGO = $request->others_creditTGO != null ? json_encode(explode(',', $request->others_creditTGO)) : null;

        if ($Report->update()) {

            return redirect()
                ->route("daily-sales.list")
                ->with([
                    "success" =>
                    " Daily Sales Reports details has been updated successfully!",
                ]);
        } else {
            return redirect()
                ->route("daily-sales.list")
                ->with([
                    "success" =>
                    "Something went to wrong",
                ]);
        }
    }

    public function Dailysalesdownload($start = null, $end = null, $branch_id = null)
    {
        if (Auth::user()->can('download_daily_sales_report')) {

            $dailysale = new DailySalesReportDSR($start, $end, $branch_id);
            $dailysale->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function dailysalesfilter(Request $request)
    {
        $headerscolumn = array('dine_in_restaurent' => 'Dine-In Restaurant'
            , 'dine_in_cabin' => 'Dine-In Cabin'
            , 'take_away_self_pickup' => 'Take Away/Self Pickup'
            , 'home_delivery' => 'Home Delivery'
            , 'buffet' => 'Buffet',
            'talabat_TEM' => 'Talabat (TMP)'
            , 'talabat_TGO' => 'Talabat (TGO)'
            , 'deliveroo_TEM' => 'Deliveroo (TMP)'
            , 'deliveroo_TGO' => 'Deliveroo (TGO)'
            , 'v_thru' => 'V-Thru'
            , 'mm_online' => 'MM Online'
            , 'osc' => 'OSC'
            , 'garden' => 'Garden'
            , 'others_gross' => 'Others'
            , 'net_sale' => 'Net SALE'
            , 'discount' => 'Discount'
            , 'complimentary' => 'Complimentary'
            , 'sale_Return' => 'Sale Return'
            , 'gross_sale' => 'GROSS SALE'
            // ,'total_collection'=>'TOTAL'
            , 'talabat_credit' => 'Credit Talabat'
            , 'deliveroo_credit' => 'Credit Deliveroo'
            , 'v_thru_credit' => 'Credit V-Thru'
            , 'MMGTC' => 'CR/CARD MMGTC'
            , 'e_gift_card' => 'Gift Card'
            , 'cash_shortage' => 'CASH SCH'
            , 'cash_in_hand_actual' => 'CASH ACTUAL'
            , 'cash_deposit_in_bank' => 'CAS DEP /OP');

        if (count($request->date_range) == 1) {
            $first_second = date('Y-m-01', );
            $last_second = date('Y-m-t', );
        } else {
            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));
        }

        //
        //Start mk coding
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

        //

        $data = DailySaleReport::whereDate("report_date", ">=", date("Y-m-d", strtotime($first_second)))->whereDate("report_date", "<=", date("Y-m-d", strtotime($last_second)))->where('branch_id', $request->branch_id)->orderBy('report_date', 'DESC')->get();

        $html = view('report.daily-reports.sales-report.daily_sales.partial', compact('data'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);
    }

    public function dailysalesDelete(Request $request)
    {

        $selected_dates = DailySaleReport::where('id', $request->id)->delete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    //Show Deleted Reports

    public function deletedReportList()
    {

        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');
        //$allBranchDeletedReports = DailySaleReport::onlyTrashed()->get();
        $allBranchDeletedReports = DailySaleReport::with('Branch')->onlyTrashed()->select(DB::raw('DATE(report_date) as date'), 'branch_id')->groupBy('date')->groupBy('branch_id')->get();

        $allBranchDeletedReports = DailySaleReport::with('Branch')->onlyTrashed()->get();

        return view('report.daily-reports.sales-report.daily_sales.deleted_list', compact('branch', 'allBranchDeletedReports'));
    }

    public function filterDailySalesDeletedReports(Request $request)
    {

        if ($request->with == 'only_branch_id') {

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = DailySaleReport::with('Branch')->onlyTrashed()->select(DB::raw('DATE(report_date) as date'), 'branch_id')->groupBy('date')->groupBy('branch_id')->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = DailySaleReport::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->select(DB::raw('DATE(report_date) as date'), 'branch_id')->groupBy('date')->groupBy('branch_id')->get();
            }

            $result_view = view('report.daily-reports.sales-report.daily_sales.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

        if ($request->with == "apply_filter") {

            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = DailySaleReport::with('Branch')->onlyTrashed()->select(DB::raw('DATE(report_date) as date'), 'branch_id')->whereBetween('report_date', [$first_second, $last_second])->groupBy('date')->groupBy('branch_id')->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = DailySaleReport::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->select(DB::raw('DATE(report_date) as date'), 'branch_id')->whereBetween('report_date', [$first_second, $last_second])->groupBy('date')->groupBy('branch_id')->get();
            }

            $result_view = view('report.daily-reports.sales-report.daily_sales.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

    }

    public function resetDailySalesDeletedReports(Request $request)
    {
        $allBranchDeletedReports = DailySaleReport::with('Branch')->onlyTrashed()->select(DB::raw('DATE(report_date) as date'), 'branch_id')->groupBy('date')->groupBy('branch_id')->get();
        $result_view = view('report.daily-reports.sales-report.daily_sales.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();
        return json_encode(['html' => $result_view, 'status' => true]);
    }

    public function restoreReport(Request $request)
    {
        $selected_dates = DailySaleReport::withTrashed()->where('branch_id', $request->branch_id)->whereDate('report_date', '=', date('Y-m-d H:i:s', strtotime($request->dates)))->restore();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function permanentDeleteReport(Request $request)
    {

        $selected_dates = DailySaleReport::withTrashed()->where('branch_id', $request->branch_id)->whereDate('report_date', '=', date('Y-m-d H:i:s', strtotime($request->dates)))->forceDelete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function paymentmethodReportList()
    {

        if (Auth::user()->can('payment_methods_branch_wise_tab_management')) {

            $headerscolumn = array('cash_sales' => 'Cash'
                , 'amex' => 'Amex'
                , 'visa' => 'Visa'
                , 'master' => 'Master'
                , 'dinner' => 'Dinner',
                'mm_online_link' => 'MM Online  Link'
                , 'knet' => 'Knet'
                , 'other_cards' => 'Other Cards'
                , 'cheque' => 'Cheque'
                , 'printed_gift_card' => 'Printed Gift Card'
                , 'e_gift_card' => 'E- Gift Card'
                , 'gift_coupon_voucher' => 'Gift Coupon/Voucher'
                , 'cash_equivalent' => 'Cash Equivalent(Others)'
                , 'talabat_credit_tmp_tgo' => 'Talabat Credit'
                , 'deliveroo_credit_tmp_tgo' => 'Deliveroo Credit'
                , 'v_thru_credit_tmp_tgo' => 'V Thru Credit'
                , 'others_credit_tmp_tgo' => 'Others'
                , 'shortage_&_overage' => 'Short & Overage',
            );

            $curMonth = date('F');
            $curYear = date('Y');
            $timestamp = strtotime($curMonth . ' ' . $curYear);
            $first_second = date('Y-m-01 00:00:00', $timestamp);
            $last_second = date('Y-m-t 12:59:59', $timestamp);
            $current_month = Carbon::now('m');
            $current_year = Carbon::now('Y');

            $branch = Branch::get()->pluck('short_name', 'id');

            $selbranch = Branch::select('id', 'short_name')->where("status", 1)->get();

            $branchs_ids = $selbranch[0]->id;

            $data = DailySaleReport::select(DB::raw('DATE(report_date) as date')
                , DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent')
                , DB::raw('SUM(dine_in_cabin) as dine_in_cabin')
                , DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup')
                , DB::raw('SUM(home_delivery) as home_delivery')
                , DB::raw('SUM(buffet) as buffet')
                , DB::raw('SUM(talabat_TEM) as talabat_TEM')
                , DB::raw('SUM(talabat_TGO) as talabat_TGO')
                , DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM')
                , DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO')
                , DB::raw('SUM(v_thru) as v_thru')
                , DB::raw('SUM(mm_online) as mm_online')
                , DB::raw('SUM(osc) as osc')
                , DB::raw('SUM(garden) as garden')
                , DB::raw('SUM(others_gross) as others_gross')
                , DB::raw('SUM(discount) as discount')
                , DB::raw('SUM(net_sale) as net_sale')
                , DB::raw('SUM(complimentary) as complimentary')
                , DB::raw('SUM(sale_Return) as sale_Return')
                , DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual')
                , DB::raw('SUM(cash_shortage) as cash_shortage')
                , DB::raw('SUM(cash_overage) as cash_overage')
                , DB::raw('SUM(amex) as amex')
                , DB::raw('SUM(visa) as visa')
                , DB::raw('SUM(master) as master')
                , DB::raw('SUM(dinner) as dinner')
                , DB::raw('SUM(mm_online_link) as mm_online_link')
                , DB::raw('SUM(knet) as knet')
                , DB::raw('SUM(other_cards) as other_cards')
                , DB::raw('SUM(cheque) as cheque')
                , DB::raw('SUM(printed_gift_card) as printed_gift_card')
                , DB::raw('SUM(e_gift_card) as e_gift_card')
                , DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher')
                , DB::raw('SUM(cash_equivalent) as cash_equivalent')

                // , DB::raw('SUM(talabat_credit) as talabat_credit')
                // , DB::raw('SUM(deliveroo_credit) as deliveroo_credit')
                // , DB::raw('SUM(v_thru_credit) as v_thru_credit')
                // , DB::raw('SUM(others_credit) as others_credit')

                , DB::raw('SUM(gross_sale) as gross_sale')
                , DB::raw('SUM(discount_return) as discount_return')

                , DB::raw('SUM(cash_in_hand) as cash_in_hand')
                , DB::raw('SUM(cards_sale) as cards_sale')
                , DB::raw('SUM(cheque_cash) as cheque_cash')
                , DB::raw('SUM(credit_sale) as credit_sale')
                , DB::raw('SUM(total_collection) as total_collection')
                , DB::raw('SUM(cash_in_hand_opening_balance) as cash_in_hand_opening_balance')
                , DB::raw('SUM(cash_sales) as cash_sales')
                , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank')
                , DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance')

            )->whereBetween('report_date', [$first_second, $last_second])->where('branch_id', $branchs_ids)->groupBy('date')->orderBy('date', 'DESC')->get();

            $date = DailySaleReport::select(DB::raw('DATE(report_date) as date'))->whereBetween('report_date', [$first_second, $last_second])->groupBy('date')
                ->get()
                ->pluck('date');

            $paymentmethod = array();
            foreach ($data as $daily) {

                $daily['shortage_&_overage'] = $daily['cash_shortage'] + $daily['cash_overage'];
                $paymentmethod[date('Y-m-d', strtotime($daily->date))] = $daily;

            }

            // $aDates = array();
            // $oStart = new DateTime(date('Y-m-01', strtotime(date('Y-m-d'))));
            // $oEnd = clone $oStart;
            // $oEnd->add(new DateInterval("P1M"));

            // while ($oStart->getTimestamp() < $oEnd->getTimestamp()) {
            //     $aDates[] = $oStart->format('d-m-Y');
            //     $day[] = $oStart->format('D');
            //     $oStart->add(new DateInterval("P1D"));
            // }

            return view('report.daily-reports.sales-report.payment_method.index', compact('paymentmethod', 'selbranch', 'headerscolumn', 'branch', 'data', 'branchs_ids'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function paymentsmethodfilter(Request $request)
    {

        $headerscolumn = array('cash_sales' => 'Cash'
            , 'amex' => 'Amex'
            , 'visa' => 'Visa'
            , 'master' => 'Master'
            , 'dinner' => 'Dinner',
            'mm_online_link' => 'MM Online  Link'
            , 'knet' => 'Knet'
            , 'other_cards' => 'Other Cards'
            , 'cheque' => 'Cheque'
            , 'printed_gift_card' => 'Printed Gift Card'
            , 'e_gift_card' => 'E- Gift Card'
            , 'gift_coupon_voucher' => 'Gift Coupon/Voucher'
            , 'cash_equivalent' => 'Cash Equivalent(Others)'
            , 'talabat_credit' => 'Talabat Credit'
            , 'deliveroo_credit' => 'Deliveroo Credit'
            , 'v_thru_credit' => 'V Thru Credit'
            , 'others_credit' => 'Others'
            , 'shortage_&_overage' => 'Short & Overage',
        );

        $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
        $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

        if ($request->from_filter != 'reset') {
            Session::put('payment_methods_branch_wise_start_date', $first_second);
            Session::put('payment_methods_branch_wise_end_date', $last_second);
            Session::put('payment_methods_branch_wise_branch_id', $request->branch_id);
        } else {
            Session::put('payment_methods_branch_wise_start_date', null);
            Session::put('payment_methods_branch_wise_end_date', null);
            Session::put('payment_methods_branch_wise_branch_id', null);

        }

        $data = DailySaleReport::select(DB::raw('DATE(report_date) as date')
            , DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent')
            , DB::raw('SUM(dine_in_cabin) as dine_in_cabin')
            , DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup')
            , DB::raw('SUM(home_delivery) as home_delivery')
            , DB::raw('SUM(buffet) as buffet')
            , DB::raw('SUM(talabat_TEM) as talabat_TEM')
            , DB::raw('SUM(talabat_TGO) as talabat_TGO')
            , DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM')
            , DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO')
            , DB::raw('SUM(v_thru) as v_thru')
            , DB::raw('SUM(mm_online) as mm_online')
            , DB::raw('SUM(osc) as osc')
            , DB::raw('SUM(garden) as garden')
            , DB::raw('SUM(others_gross) as others_gross')
            , DB::raw('SUM(discount) as discount')
            , DB::raw('SUM(net_sale) as net_sale')
            , DB::raw('SUM(complimentary) as complimentary')
            , DB::raw('SUM(sale_Return) as sale_Return')
            , DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual')
            , DB::raw('SUM(cash_shortage) as cash_shortage')
            , DB::raw('SUM(cash_overage) as cash_overage')
            , DB::raw('SUM(amex) as amex')
            , DB::raw('SUM(visa) as visa')
            , DB::raw('SUM(master) as master')
            , DB::raw('SUM(dinner) as dinner')
            , DB::raw('SUM(mm_online_link) as mm_online_link')
            , DB::raw('SUM(knet) as knet')
            , DB::raw('SUM(other_cards) as other_cards')
            , DB::raw('SUM(cheque) as cheque')
            , DB::raw('SUM(printed_gift_card) as printed_gift_card')
            , DB::raw('SUM(e_gift_card) as e_gift_card')
            , DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher')
            , DB::raw('SUM(cash_equivalent) as cash_equivalent')
            // , DB::raw('SUM(talabat_credit) as talabat_credit')
            // , DB::raw('SUM(deliveroo_credit) as deliveroo_credit')
            // , DB::raw('SUM(v_thru_credit) as v_thru_credit')
            // , DB::raw('SUM(others_credit) as others_credit')
            , DB::raw('SUM(gross_sale) as gross_sale')
            , DB::raw('SUM(discount_return) as discount_return')
            , DB::raw('SUM(cash_in_hand) as cash_in_hand')
            , DB::raw('SUM(cards_sale) as cards_sale')
            , DB::raw('SUM(cheque_cash) as cheque_cash')
            , DB::raw('SUM(credit_sale) as credit_sale')
            , DB::raw('SUM(total_collection) as total_collection')
            , DB::raw('SUM(cash_in_hand_opening_balance) as cash_in_hand_opening_balance')
            , DB::raw('SUM(cash_sales) as cash_sales')
            , DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank')
            , DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance')

        )->where("report_date", ">=", date("Y-m-d", strtotime($first_second)))->where("report_date", "<=", date("Y-m-d", strtotime($last_second)))->where('branch_id', $request->branch_id)->groupBy('date')->orderBy('date')->get();

        $date = DailySaleReport::select(DB::raw('DATE(report_date) as date'))->where("report_date", ">=", date("Y-m-d", strtotime($first_second)))->where("report_date", "<=", date("Y-m-d", strtotime($last_second)))->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('date');

        $branchs_ids = $request->branch_id;

        $paymentmethod = array();
        foreach ($data as $daily) {
            $daily['shortage_&_overage'] = $daily['cash_shortage'] + $daily['cash_overage'];
            $paymentmethod[date('Y-m-d', strtotime($daily->date))] = $daily;
        }

        $html = view('report.daily-reports.sales-report.payment_method.partial', compact('paymentmethod', 'headerscolumn', 'branchs_ids', 'data'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);

    }

    public function paymentmethodsdownlaod($start = null, $end = null, $branch_id)
    {
        if (Auth::user()->can('download_payment_methods_branch_wise_report')) {
            $payment = new PaymentMethod($start, $end, $branch_id);
            $payment->result();

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function BranchsalesList()
    {

        //endmk
        if (Auth::user()->can('sales_by_branch_tab_management')) {

            //mk

            $curMonth = date('F');
            $curYear = date('Y');
            $timestamp = strtotime($curMonth . ' ' . $curYear);
            $first_second = date('Y-m-01 00:00:00', $timestamp);
            $last_second = date('Y-m-t 12:59:59', $timestamp);

            $branch_demo = Branch::where('status', '1')->get()->pluck('id')->toArray();
            $all_total_keys_with_branch = array();
            $sum = 0;
            foreach ($branch_demo as $branch) {

                $data = DailySaleReport::where('branch_id', $branch)->where('report_date', '>=', $first_second)
                    ->where('report_date', '<=', $last_second)->pluck('gross_sale')->toArray();

                $all_total_keys_with_branch += [$branch => array_sum($data)];
                $sum = +$sum + array_sum($data);
            }

            $all_total_keys_with_branch += ['total' => $sum];
            //  dump($all_total_keys_with_branch);

            $branches = Branch::where("status", '1')->get();

            $html_design = '';

            $html_design .= '<tr id="show_total_amt">';
            $html_design .= '<th colspan="2" style="color:green">Total</th>';

            foreach ($all_total_keys_with_branch as $branch_total_gross_sale) {
                $html_design .= '<th style="color:green">' . ($branch_total_gross_sale == 0 ? '-' : number_format($branch_total_gross_sale, 3)) . '</th>';

            }

            $html_design .= '</tr>';

            $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
                , DB::raw('SUM(gross_sale) as gross_sale'))
                ->orderBy('date', 'ASC')
                ->groupBy('date', 'branch_id')
                ->get();

            $salesbranch = array();

            foreach ($data as $value_bank) {
                $salesbranch[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
            }

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

            return view('report.daily-reports.sales-report.sale_by_branch.index', compact('branch', 'salesbranch', 'html_design'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function SalesBranchFilter(Request $request)
    {

        $report_date_1 = str_replace("/", "-", $request->date_range[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $request->date_range[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        if ($request->from_filter != 'reset') {
            Session::put('sales_by_branch_start_date', $report_date_1);
            Session::put('sales_by_branch_end_date', $report_date_2);

        } else {
            Session::put('sales_by_branch_start_date', null);
            Session::put('sales_by_branch_end_date', null);

        }

        $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
            , DB::raw('SUM(gross_sale) as gross_sale'))
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderBy('date', 'ASC')
            ->groupBy('date', 'branch_id')
            ->get();

        $salesbranch = array();

        foreach ($data as $value_bank) {
            $salesbranch[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
        }

        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');

        $html = view('report.daily-reports.sales-report.sale_by_branch.partial', compact('branch', 'salesbranch'))->render();

        //mk total gross sale get

        $branch_demo = Branch::where('status', '1')->get()->pluck('id')->toArray();
        $all_total_keys_with_branch = array();
        $sum = 0;
        foreach ($branch_demo as $branch) {

            $data = DailySaleReport::where('branch_id', $branch)->where('report_date', '>=', $report_date_1)
                ->where('report_date', '<=', $report_date_2)->pluck('gross_sale')->toArray();

            $all_total_keys_with_branch += [$branch => array_sum($data)];
            $sum = +$sum + array_sum($data);
        }

        $all_total_keys_with_branch += ['total' => $sum];
        //  dump($all_total_keys_with_branch);

        $branches = Branch::where("status", '1')->get();

        $html_design = '';

        //$html_design .= '<tr>';
        $html_design .= '<th colspan="2" style="color:green">Total</th>';

        foreach ($all_total_keys_with_branch as $branch_total_gross_sale) {
            $html_design .= '<th style="color:green">' . ($branch_total_gross_sale == 0 ? '-' : number_format($branch_total_gross_sale, 3)) . '</th>';

        }

        //$html_design .= '</tr>';

        //endmk

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'html_design' => $html_design,

        ]);

    }

    public function BranchSalesdownload($start = null, $end = null)
    {
        if (Auth::user()->can('download_sales_by_branch_report')) {

            $payment = new BranchSales($start, $end);
            $payment->result();

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function SalesMonthlist(Request $request)
    {
        if (Auth::user()->can('sales_by_month_tab_management')) {

            $headerscolumn = $this->headersalesmonth();
            $current_year = Carbon::now('Y');
            $branch = Branch::get()->pluck('short_name', 'id');
            $selbranch = Branch::select('short_name', 'id')->get()->first();

            $data_value = DailySaleReport::select(DB::raw('Month(report_date) as month'),
                DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent'),
                DB::raw('SUM(dine_in_cabin) as dine_in_cabin'),
                DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup'),
                DB::raw('SUM(home_delivery) as home_delivery'),
                DB::raw('SUM(buffet) as buffet'),
                DB::raw('SUM(talabat_TEM) as talabat_TEM'),
                DB::raw('SUM(talabat_TGO) as talabat_TGO'),
                DB::raw('SUM(MM_Express_TGO) as MM_Express_TGO'),
                DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM'),
                DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO'),
                DB::raw('SUM(v_thru) as v_thru'),
                DB::raw('SUM(mm_online) as mm_online'),
                DB::raw('SUM(osc) as osc'),
                DB::raw('SUM(garden) as garden'),
                DB::raw('SUM(others_gross) as others_gross'),
                DB::raw('SUM(discount) as discount'),
                DB::raw('SUM(complimentary) as complimentary'),
                DB::raw('SUM(sale_Return) as sale_Return'),
                DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual'),
                DB::raw('SUM(cash_shortage) as cash_shortage'),
                DB::raw('SUM(cash_overage) as cash_overage'),
                DB::raw('SUM(amex) as amex'),
                DB::raw('SUM(visa) as visa'),
                DB::raw('SUM(master) as master'),
                DB::raw('SUM(dinner) as dinner'),
                DB::raw('SUM(mm_online_link) as mm_online_link'),
                DB::raw('SUM(knet) as knet'),
                DB::raw('SUM(other_cards) as other_cards'),
                DB::raw('SUM(cheque) as cheque'),
                DB::raw('SUM(printed_gift_card) as printed_gift_card'),
                DB::raw('SUM(e_gift_card) as e_gift_card'),
                DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher'),
                DB::raw('SUM(cash_equivalent) as cash_equivalent'),
                // DB::raw('SUM(talabat_credit) as talabat_credit'),
                // DB::raw('SUM(deliveroo_credit) as deliveroo_credit'),
                // DB::raw('SUM(v_thru_credit) as v_thru_credit'),
                // DB::raw('SUM(others_credit) as others_credit'),
                DB::raw('SUM(gross_sale) as gross_sale'),
                DB::raw('SUM(discount_return) as discount_return'),
                DB::raw('SUM(net_sale) as net_sale'),
                DB::raw('SUM(cash_in_hand) as cash_in_hand'),
                DB::raw('SUM(cards_sale) as cards_sale'),
                DB::raw('SUM(cheque_cash) as cheque_cash'),
                DB::raw('SUM(credit_sale) as credit_sale'),
                DB::raw('SUM(total_collection) as total_collection'),
                DB::raw('SUM(cash_in_hand_opening_balance) as ash_in_hand_opening_balance'),
                DB::raw('SUM(cash_sales) as cash_sales'),
                DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'),
                DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance'),
            )->whereYear('report_date', $current_year)->where('branch_id', $selbranch->id)->groupBy('month')->get();

            $month_datavalue = array();
            foreach ($data_value as $month_value) {
                $month_datavalue[$month_value->month] = $month_value;
            }

            //dump($month_datavalue);
            $sel_month = array_keys($month_datavalue);
            $allmonth = array();

            for ($i = 1; $i <= 12; $i++) {
                if (in_array($i, $sel_month)) {
                    $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
                }
            }

            // $allmonth = array_intersect_key($month_datavalue, $allmonth);

            return view('report.daily-reports.sales-report.sale_by_month.index', compact('headerscolumn', 'month_datavalue', 'allmonth', 'branch', 'selbranch'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function SalesMonthFilter(Request $request)
    {

        $headerscolumn = $this->headersalesmonth();

        $data_value = DailySaleReport::select(DB::raw('Month(report_date) as month'),
            DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent'),
            DB::raw('SUM(dine_in_cabin) as dine_in_cabin'),
            DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup'),
            DB::raw('SUM(home_delivery) as home_delivery'),
            DB::raw('SUM(buffet) as buffet'),
            DB::raw('SUM(talabat_TEM) as talabat_TEM'),
            DB::raw('SUM(talabat_TGO) as talabat_TGO'),
            DB::raw('SUM(MM_Express_TGO) as MM_Express_TGO'),
            DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM'),
            DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO'),
            DB::raw('SUM(v_thru) as v_thru'),
            DB::raw('SUM(mm_online) as mm_online'),
            DB::raw('SUM(osc) as osc'),
            DB::raw('SUM(garden) as garden'),
            DB::raw('SUM(others_gross) as others_gross'),
            DB::raw('SUM(discount) as discount'),
            DB::raw('SUM(complimentary) as complimentary'),
            DB::raw('SUM(sale_Return) as sale_Return'),
            DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual'),
            DB::raw('SUM(cash_shortage) as cash_shortage'),
            DB::raw('SUM(cash_overage) as cash_overage'),
            DB::raw('SUM(amex) as amex'),
            DB::raw('SUM(visa) as visa'),
            DB::raw('SUM(master) as master'),
            DB::raw('SUM(dinner) as dinner'),
            DB::raw('SUM(mm_online_link) as mm_online_link'),
            DB::raw('SUM(knet) as knet'),
            DB::raw('SUM(other_cards) as other_cards'),
            DB::raw('SUM(cheque) as cheque'),
            DB::raw('SUM(printed_gift_card) as printed_gift_card'),
            DB::raw('SUM(e_gift_card) as e_gift_card'),
            DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher'),
            DB::raw('SUM(cash_equivalent) as cash_equivalent'),
            // DB::raw('SUM(talabat_credit) as talabat_credit'),
            // DB::raw('SUM(deliveroo_credit) as deliveroo_credit'),
            // DB::raw('SUM(v_thru_credit) as v_thru_credit'),
            // DB::raw('SUM(others_credit) as others_credit'),
            DB::raw('SUM(gross_sale) as gross_sale'),
            DB::raw('SUM(discount_return) as discount_return'),
            DB::raw('SUM(net_sale) as net_sale'),
            DB::raw('SUM(cash_in_hand) as cash_in_hand'),
            DB::raw('SUM(cards_sale) as cards_sale'),
            DB::raw('SUM(cheque_cash) as cheque_cash'),
            DB::raw('SUM(credit_sale) as credit_sale'),
            DB::raw('SUM(total_collection) as total_collection'),
            DB::raw('SUM(cash_in_hand_opening_balance) as ash_in_hand_opening_balance'),
            DB::raw('SUM(cash_sales) as cash_sales'),
            DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'),
            DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance'),
        )->whereYear('report_date', $request->year)->where('branch_id', $request->branch_id)->groupBy('month')->get();

        if ($request->from_filter != 'reset') {
            Session::put('sales_by_month_start_year', $request->year);
            Session::put('sales_by_month_branch_id', $request->branch_id);
        } else {
            Session::put('sales_by_month_start_year', null);
            Session::put('sales_by_month_branch_id', null);

        }

        $month_datavalue = array();
        foreach ($data_value as $month_value) {
            $month_datavalue[$month_value->month] = $month_value;

        }

        $sel_month = array_keys($month_datavalue);
        $allmonth = array();

        for ($i = 1; $i <= 12; $i++) {
            if (in_array($i, $sel_month)) {
                $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, $request->year))] = date("M-Y", mktime(0, 0, 0, $i, 1, $request->year));
            }
        }

        $html = view('report.daily-reports.sales-report.sale_by_month.partial', compact('headerscolumn', 'month_datavalue', 'allmonth'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);

    }

    public function headersalesmonth()
    {
        $header = array('dine_in_restaurent' => 'Dine-In Restaurant'
            , 'dine_in_cabin' => 'Dine-In Cabin'
            , 'take_away_self_pickup' => 'Take Away/Self Pickup'
            , 'home_delivery' => 'Home Delivery'
            , 'buffet' => 'Buffet',
            'talabat_TEM' => 'Talabat (TMP)'
            , 'talabat_TGO' => 'Talabat (TGO)'
            , 'MM_Express_TGO' => 'MM Express(TGO)'
            , 'deliveroo_TEM' => 'Deliveroo (TMP)'
            , 'deliveroo_TGO' => 'Deliveroo (TGO)'
            , 'v_thru' => 'V-Thru'
            , 'mm_online' => 'MM Online'
            , 'osc' => 'OSC'
            , 'garden' => 'Garden'
            , 'others_gross' => 'Others'
            , 'net_sale' => 'Net SALE'
            , 'discount' => 'Discount'
            , 'complimentary' => 'Complimentary'
            , 'sale_Return' => 'Sale Return'
            , 'gross_sale' => 'Gross Sale',
        );

        return $header;

    }

    public function Monthsalesdownload($year = null, $branch_id = null)
    {
        if (Auth::user()->can('download_sales_by_month_report')) {
            $monthsales = new Monthsales($year, $branch_id);
            $monthsales->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function Salesservicelist()
    {

        if (Auth::user()->can('sales_by_service_tab_management')) {
            $headerscolumn = $this->headersalesmonth();

            $current_year = Carbon::now('Y');
            $current_month = Carbon::now('m');

            $branch = Branch::get()->pluck('short_name', 'id');

            $data_value = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month'),
                DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent'),
                DB::raw('SUM(dine_in_cabin) as dine_in_cabin'),
                DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup'),
                DB::raw('SUM(home_delivery) as home_delivery'),
                DB::raw('SUM(buffet) as buffet'),
                DB::raw('SUM(talabat_TEM) as talabat_TEM'),
                DB::raw('SUM(talabat_TGO) as talabat_TGO'),
                DB::raw('SUM(MM_Express_TGO) as MM_Express_TGO'),
                DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM'),
                DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO'),
                DB::raw('SUM(v_thru) as v_thru'),
                DB::raw('SUM(mm_online) as mm_online'),
                DB::raw('SUM(osc) as osc'),
                DB::raw('SUM(garden) as garden'),
                DB::raw('SUM(others_gross) as others_gross'),
                DB::raw('SUM(discount) as discount'),
                DB::raw('SUM(complimentary) as complimentary'),
                DB::raw('SUM(sale_Return) as sale_Return'),
                DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual'),
                DB::raw('SUM(cash_shortage) as cash_shortage'),
                DB::raw('SUM(cash_overage) as cash_overage'),
                DB::raw('SUM(amex) as amex'),
                DB::raw('SUM(visa) as visa'),
                DB::raw('SUM(master) as master'),
                DB::raw('SUM(dinner) as dinner'),
                DB::raw('SUM(mm_online_link) as mm_online_link'),
                DB::raw('SUM(knet) as knet'),
                DB::raw('SUM(other_cards) as other_cards'),
                DB::raw('SUM(cheque) as cheque'),
                DB::raw('SUM(printed_gift_card) as printed_gift_card'),
                DB::raw('SUM(e_gift_card) as e_gift_card'),
                DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher'),
                DB::raw('SUM(cash_equivalent) as cash_equivalent'),
                // DB::raw('SUM(talabat_credit) as talabat_credit'),
                // DB::raw('SUM(deliveroo_credit) as deliveroo_credit'),
                // DB::raw('SUM(v_thru_credit) as v_thru_credit'),
                // DB::raw('SUM(others_credit) as others_credit'),
                DB::raw('SUM(gross_sale) as gross_sale'),
                DB::raw('SUM(discount_return) as discount_return'),
                DB::raw('SUM(net_sale) as net_sale'),
                DB::raw('SUM(cash_in_hand) as cash_in_hand'),
                DB::raw('SUM(cards_sale) as cards_sale'),
                DB::raw('SUM(cheque_cash) as cheque_cash'),
                DB::raw('SUM(credit_sale) as credit_sale'),
                DB::raw('SUM(total_collection) as total_collection'),
                DB::raw('SUM(cash_in_hand_opening_balance) as ash_in_hand_opening_balance'),
                DB::raw('SUM(cash_sales) as cash_sales'),
                DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'),
                DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance'),
            )->whereYear('report_date', $current_year)->whereMonth('report_date', $current_month)->groupBy('month', 'branch_id')->get();

            $month_datavalue = array();
            foreach ($data_value as $month_value) {
                $month_datavalue[$month_value->branch_id] = $month_value;

            }

            $allmonth[(int) date('m')] = date('M-Y');
            return view('report.daily-reports.sales-report.sale_by_service.index', compact('headerscolumn', 'month_datavalue', 'branch', 'allmonth'));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function SalesserviceFilter(Request $request)
    {

        $headerscolumn = $this->headersalesmonth();

        $current_year = $request->year;
        $current_month = $request->month;

        $branch = Branch::get()->pluck('short_name', 'id');

        $data_value = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month'),
            DB::raw('SUM(dine_in_restaurent) as dine_in_restaurent'),
            DB::raw('SUM(dine_in_cabin) as dine_in_cabin'),
            DB::raw('SUM(take_away_self_pickup) as take_away_self_pickup'),
            DB::raw('SUM(home_delivery) as home_delivery'),
            DB::raw('SUM(buffet) as buffet'),
            DB::raw('SUM(talabat_TEM) as talabat_TEM'),
            DB::raw('SUM(talabat_TGO) as talabat_TGO'),
            DB::raw('SUM(MM_Express_TGO) as MM_Express_TGO'),
            DB::raw('SUM(deliveroo_TEM) as deliveroo_TEM'),
            DB::raw('SUM(deliveroo_TGO) as deliveroo_TGO'),
            DB::raw('SUM(v_thru) as v_thru'),
            DB::raw('SUM(mm_online) as mm_online'),
            DB::raw('SUM(osc) as osc'),
            DB::raw('SUM(garden) as garden'),
            DB::raw('SUM(others_gross) as others_gross'),
            DB::raw('SUM(discount) as discount'),
            DB::raw('SUM(complimentary) as complimentary'),
            DB::raw('SUM(sale_Return) as sale_Return'),
            DB::raw('SUM(cash_in_hand_actual) as cash_in_hand_actual'),
            DB::raw('SUM(cash_shortage) as cash_shortage'),
            DB::raw('SUM(cash_overage) as cash_overage'),
            DB::raw('SUM(amex) as amex'),
            DB::raw('SUM(visa) as visa'),
            DB::raw('SUM(master) as master'),
            DB::raw('SUM(dinner) as dinner'),
            DB::raw('SUM(mm_online_link) as mm_online_link'),
            DB::raw('SUM(knet) as knet'),
            DB::raw('SUM(other_cards) as other_cards'),
            DB::raw('SUM(cheque) as cheque'),
            DB::raw('SUM(printed_gift_card) as printed_gift_card'),
            DB::raw('SUM(e_gift_card) as e_gift_card'),
            DB::raw('SUM(gift_coupon_voucher) as gift_coupon_voucher'),
            DB::raw('SUM(cash_equivalent) as cash_equivalent'),
            // DB::raw('SUM(talabat_credit) as talabat_credit'),
            // DB::raw('SUM(deliveroo_credit) as deliveroo_credit'),
            // DB::raw('SUM(v_thru_credit) as v_thru_credit'),
            // DB::raw('SUM(others_credit) as others_credit'),
            DB::raw('SUM(gross_sale) as gross_sale'),
            DB::raw('SUM(discount_return) as discount_return'),
            DB::raw('SUM(net_sale) as net_sale'),
            DB::raw('SUM(cash_in_hand) as cash_in_hand'),
            DB::raw('SUM(cards_sale) as cards_sale'),
            DB::raw('SUM(cheque_cash) as cheque_cash'),
            DB::raw('SUM(credit_sale) as credit_sale'),
            DB::raw('SUM(total_collection) as total_collection'),
            DB::raw('SUM(cash_in_hand_opening_balance) as ash_in_hand_opening_balance'),
            DB::raw('SUM(cash_sales) as cash_sales'),
            DB::raw('SUM(cash_deposit_in_bank) as cash_deposit_in_bank'),
            DB::raw('SUM(cash_in_hand_closing_balance) as cash_in_hand_closing_balance'),
        )->whereYear('report_date', $current_year)->whereMonth('report_date', $current_month)->groupBy('month', 'branch_id')->get();

        //Start filter prevent.....

        if ($request->from_filter != 'reset') {
            Session::put('sales_by_service_month', $current_month);
            Session::put('sales_by_service_year', $current_year);
        } else {
            Session::put('sales_by_service_month', null);
            Session::put('sales_by_service_year', null);

        }

        $month_datavalue = array();
        foreach ($data_value as $month_value) {
            $month_datavalue[$month_value->branch_id] = $month_value;

        }

        $allmonth = date("M-Y", mktime(0, 0, 0, $current_month, 1, $current_year));

        $html = view('report.daily-reports.sales-report.sale_by_service.partial', compact('headerscolumn', 'month_datavalue', 'allmonth', 'branch'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);
    }

    public function saleservicedownlaod($year = null, $month = null)
    {
        if (Auth::user()->can('download_sales_by_service_report')) {

            $saleservice = new SalesServiceReport($year, $month);
            $saleservice->result();
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Start Mk Net Sale coding

    public function BranchNetsalesList()
    {
        if (Auth::user()->can('sales_by_branch_net_sale_tab_management')) {

            //mk

            $curMonth = date('F');
            $curYear = date('Y');
            $timestamp = strtotime($curMonth . ' ' . $curYear);
            $first_second = date('Y-m-01 00:00:00', $timestamp);
            $last_second = date('Y-m-t 12:59:59', $timestamp);

            $branch_demo = Branch::where('status', '1')->get()->pluck('id')->toArray();
            $all_total_keys_with_branch = array();
            $sum = 0;
            foreach ($branch_demo as $branch) {

                $data = DailySaleReport::where('branch_id', $branch)->where('report_date', '>=', $first_second)
                    ->where('report_date', '<=', $last_second)->pluck('net_sale')->toArray();

                $all_total_keys_with_branch += [$branch => array_sum($data)];
                $sum = +$sum + array_sum($data);
            }

            $all_total_keys_with_branch += ['total' => $sum];
            //  dump($all_total_keys_with_branch);

            $branches = Branch::where("status", '1')->get();

            $html_design = '';

            $html_design .= '<tr id="show_total_amt">';
            $html_design .= '<th colspan="2" style="color:green">Total</th>';

            foreach ($all_total_keys_with_branch as $branch_total_gross_sale) {
                $html_design .= '<th style="color:green">' . ($branch_total_gross_sale == 0 ? '-' : number_format($branch_total_gross_sale, 3)) . '</th>';

            }

            $html_design .= '</tr>';

            //endmk

            $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
                , DB::raw('SUM(net_sale) as net_sale'))
                ->orderBy('date', 'ASC')
                ->groupBy('date', 'branch_id')
                ->get();

            $salesbranch = array();

            foreach ($data as $value_bank) {
                $salesbranch[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
            }

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

            return view('report.daily-reports.sales-report.sale_by_branch_net_sale.index', compact('branch', 'salesbranch', 'html_design'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function SalesBranchFilterNetSale(Request $request)
    {

        $report_date_1 = str_replace("/", "-", $request->date_range[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $request->date_range[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        if ($request->from_filter != 'reset') {
            Session::put('sales_by_branch_net_start_date', $report_date_1);
            Session::put('sales_by_branch_net_end_date', $report_date_2);

        } else {
            Session::put('sales_by_branch_net_start_date', null);
            Session::put('sales_by_branch_net_end_date', null);

        }

        $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
            , DB::raw('SUM(net_sale) as net_sale'))
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderBy('date', 'ASC')
            ->groupBy('date', 'branch_id')
            ->get();

        $salesbranch = array();

        foreach ($data as $value_bank) {
            $salesbranch[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
        }

        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');

        $html = view('report.daily-reports.sales-report.sale_by_branch_net_sale.partial', compact('branch', 'salesbranch'))->render();

        //mk total gross sale get

        $branch_demo = Branch::where('status', '1')->get()->pluck('id')->toArray();
        $all_total_keys_with_branch = array();
        $sum = 0;
        foreach ($branch_demo as $branch) {

            $data = DailySaleReport::where('branch_id', $branch)->where('report_date', '>=', $report_date_1)
                ->where('report_date', '<=', $report_date_2)->pluck('net_sale')->toArray();

            $all_total_keys_with_branch += [$branch => array_sum($data)];
            $sum = +$sum + array_sum($data);
        }

        $all_total_keys_with_branch += ['total' => $sum];
        //  dump($all_total_keys_with_branch);

        $branches = Branch::where("status", '1')->get();

        $html_design = '';

        //$html_design .= '<tr>';
        $html_design .= '<th colspan="2" style="color:green">Total</th>';

        foreach ($all_total_keys_with_branch as $branch_total_gross_sale) {
            $html_design .= '<th style="color:green">' . ($branch_total_gross_sale == 0 ? '-' : number_format($branch_total_gross_sale, 3)) . '</th>';

        }

        //$html_design .= '</tr>';

        //endmk

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'html_design' => $html_design,

        ]);

    }

    public function BranchNetSalesdownload($start = null, $end = null)
    {
        if (Auth::user()->can('download_sales_by_branch_net_sale_report')) {

            $payment = new BranchNetSales($start, $end);
            $payment->result();

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //End Mk Net Sale coding

    //Start  Discount  coding

    public function BranchDiscountsalesList()
    {
        if (Auth::user()->can('sales_by_branch_discount_sale_tab_management')) {

            $year = date('Y');

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

            $monthdiscount = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
                , DB::raw('SUM(discount) as discount'))
                ->whereYear('report_date', $year)
                ->groupBy('month', 'branch_id')
                ->get();

            // $dailymonthdiscount = array();
            $monthdiscount_check = array();

            foreach ($monthdiscount as $key => $data) {
                // return $data['month'];
                if (!in_array($data['month'], $monthdiscount_check)) {
                    // $month[] = $data['month'];
                    $monthdiscount_check[$data['month']][$data['branch_id']] = $data;

                }
            }

            $allmonth = array();

            for ($i = 1; $i <= 12; $i++) {
                // if (in_array($i, $sel_month)) {
                $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
                // }
            }

            $branch_total_sum = array();

            $branch1 = array();

            return view('report.daily-reports.sales-report.sale_by_branch-discount.index', compact('branch', 'monthdiscount_check', 'allmonth', 'year'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function SalesBranchFilterdDiscountSale(Request $request)
    {

        try {

            if ($request->has('reset') && $request->reset != null && $request->reset != '') {
                $year = date('Y');
                Session::put('sales_by_branch_discount_year', null);
            } else {
                $year = $request->year;
                Session::put('sales_by_branch_discount_year', $year);
            }

            $monthdiscount = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
                , DB::raw('SUM(discount) as discount'))
                ->whereYear('report_date', $year)
                ->groupBy('month', 'branch_id')
                ->get();

            $monthdiscount_check = array();

            foreach ($monthdiscount as $key => $data) {
                // return $data['month'];
                if (!in_array($data['month'], $monthdiscount_check)) {
                    // $month[] = $data['month'];
                    $monthdiscount_check[$data['month']][$data['branch_id']] = $data;

                }
            }

            $allmonth = array();

            for ($i = 1; $i <= 12; $i++) {
                // if (in_array($i, $sel_month)) {
                $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
                // }
            }

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

            $html = view('report.daily-reports.sales-report.sale_by_branch-discount.partial', compact('branch', 'monthdiscount_check', 'allmonth', 'year'))->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }

    }

    public function BranchDiscountSalesdownload($year)
    {

        if (Auth::user()->can('download_sales_by_branch_discount_sale_report')) {

            $payment = new DiscountSalesdownload($year);
            $payment->result();

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function HeaderTotal(Request $request)
    {

        //  To Fill Total Header //

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

        $total_header = '';

        $total_header .= '<th class="table_th" style="white-space: nowrap;padding:10px; color:green;">Total</th>';

        $total_sum = 0;

        foreach ($branch as $key => $brn) {
            $yearlydiscount = DailySaleReport::select('branch_id', DB::raw('Year(report_date) as year')
                , DB::raw('SUM(discount) as discount'))
                ->whereYear('report_date', $request->year)
                ->where('branch_id', $key)
                ->groupBy('year', 'branch_id')
                ->first();

            $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . (@$yearlydiscount['discount'] == null ? '-' : number_format((float) @$yearlydiscount['discount'], 3, '.', '')) . '</th>';

            $total_sum = $total_sum+@$yearlydiscount['discount'];
        }

        $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . number_format((float) $total_sum, 3, '.', '') . '</th>';

        return response()->json([
            'status' => 'success',
            'total_header' => $total_header,
            'total_sum' => $total_sum,
        ]);

        //  --------------- //
    }

    //End Discount coding


     //Start  Branch Compliment Discount Return coding

     public function BranchDiscountComplimentsalesList()
     {
        //  if (Auth::user()->can('sales_by_branch_discount_sale_tab_management')) {

             $year = date('Y');

             $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

             $monthdiscount = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
                 , DB::raw('SUM(discount_return) as discount'))
                 ->whereYear('report_date', $year)
                 ->groupBy('month', 'branch_id')
                 ->get();

             // $dailymonthdiscount = array();
             $monthdiscount_check = array();

             foreach ($monthdiscount as $key => $data) {
                 // return $data['month'];
                 if (!in_array($data['month'], $monthdiscount_check)) {
                     // $month[] = $data['month'];
                     $monthdiscount_check[$data['month']][$data['branch_id']] = $data;

                 }
             }

             $allmonth = array();

             for ($i = 1; $i <= 12; $i++) {
                 // if (in_array($i, $sel_month)) {
                 $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
                 // }
             }

             $branch_total_sum = array();

             $branch1 = array();

             return view('report.daily-reports.sales-report.sale_by_branch_discount_compliment_return.index', compact('branch', 'monthdiscount_check', 'allmonth', 'year'));

        //  } else {
        //      return redirect()
        //          ->route("dashboard")
        //          ->with(
        //              "warning",
        //              "You do not have permission for this action!"
        //          );
        //  }
     }

     public function SalesBranchFilterdDiscountComplimentSale(Request $request)
     {

         try {

             if ($request->has('reset') && $request->reset != null && $request->reset != '') {
                 $year = date('Y');
                 Session::put('sales_by_branch_discount_compliment_year', null);
             } else {
                 $year = $request->year;
                 Session::put('sales_by_branch_discount_compliment_year', $year);
             }

             $monthdiscount = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
                 , DB::raw('SUM(discount_return) as discount'))
                 ->whereYear('report_date', $year)
                 ->groupBy('month', 'branch_id')
                 ->get();

             $monthdiscount_check = array();

             foreach ($monthdiscount as $key => $data) {
                 // return $data['month'];
                 if (!in_array($data['month'], $monthdiscount_check)) {
                     // $month[] = $data['month'];
                     $monthdiscount_check[$data['month']][$data['branch_id']] = $data;

                 }
             }

             $allmonth = array();

             for ($i = 1; $i <= 12; $i++) {
                 // if (in_array($i, $sel_month)) {
                 $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
                 // }
             }

             $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

             $html = view('report.daily-reports.sales-report.sale_by_branch_discount_compliment_return.partial', compact('branch', 'monthdiscount_check', 'allmonth', 'year'))->render();

             return response()->json([
                 'status' => 'success',
                 'html' => $html,
             ]);

         } catch (\Exception $e) {
             return response()->json([
                 'status' => false,
                 'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
             ], 200);
         }

     }

     public function BranchDiscountComplimentSalesdownload($year)
     {

        //  if (Auth::user()->can('download_sales_by_branch_discount_sale_report')) {

             $payment = new DiscountComplimentReturndownload($year);
             $payment->result();

        //  } else {
        //      return redirect()
        //          ->route("dashboard")
        //          ->with(
        //              "warning",
        //              "You do not have permission for this action!"
        //          );
        //  }
     }

     public function DiscountComplimentHeaderTotal(Request $request)
     {

         //  To Fill Total Header //

         $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

         $total_header = '';

         $total_header .= '<th class="table_th" style="white-space: nowrap;padding:10px; color:green;">Total</th>';

         $total_sum = 0;

         foreach ($branch as $key => $brn) {
             $yearlydiscount = DailySaleReport::select('branch_id', DB::raw('Year(report_date) as year')
                 , DB::raw('SUM(discount_return) as discount'))
                 ->whereYear('report_date', $request->year)
                 ->where('branch_id', $key)
                 ->groupBy('year', 'branch_id')
                 ->first();

             $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . (@$yearlydiscount['discount'] == null ? '-' : number_format((float) @$yearlydiscount['discount'], 3, '.', '')) . '</th>';

             $total_sum = $total_sum+@$yearlydiscount['discount'];
         }

         $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . number_format((float) $total_sum, 3, '.', '') . '</th>';

         return response()->json([
             'status' => 'success',
             'total_header' => $total_header,
             'total_sum' => $total_sum,
         ]);

         //  --------------- //
     }

     //End Discount coding

    // Start Gross Sale Monthly Coding .............

    public function BranchGrossSaleMonthly()
    {

         if (Auth::user()->can('sales_by_branch_gross_sale_monthly_tab_management')) {

        $year = date('Y');

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

        $monthdiscount = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
            , DB::raw('SUM(gross_sale) as discount'))
            ->whereYear('report_date', $year)
            ->groupBy('month', 'branch_id')
            ->get();

        // $dailymonthdiscount = array();
        $monthdiscount_check = array();

        foreach ($monthdiscount as $key => $data) {
            // return $data['month'];
            if (!in_array($data['month'], $monthdiscount_check)) {
                // $month[] = $data['month'];
                $monthdiscount_check[$data['month']][$data['branch_id']] = $data;

            }
        }

        $allmonth = array();

        for ($i = 1; $i <= 12; $i++) {
            // if (in_array($i, $sel_month)) {
            $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
            // }
        }

        $branch_total_sum = array();

        $branch1 = array();

        return view('report.daily-reports.sales-report.sale_by_branch_gross_monthly.index', compact('branch', 'monthdiscount_check', 'allmonth', 'year'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function SalesBranchFilterdGrossSaleMonthly(Request $request)
    {

        try {

            if ($request->has('reset') && $request->reset != null && $request->reset != '') {
                $year = date('Y');
                Session::put('sales_by_branch_discount_year', null);
            } else {
                $year = $request->year;
                Session::put('sales_by_branch_discount_year', $year);
            }

            $monthdiscount = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
                , DB::raw('SUM(gross_sale) as discount'))
                ->whereYear('report_date', $year)
                ->groupBy('month', 'branch_id')
                ->get();

            $monthdiscount_check = array();

            foreach ($monthdiscount as $key => $data) {
                // return $data['month'];
                if (!in_array($data['month'], $monthdiscount_check)) {
                    // $month[] = $data['month'];
                    $monthdiscount_check[$data['month']][$data['branch_id']] = $data;

                }
            }

            $allmonth = array();

            for ($i = 1; $i <= 12; $i++) {
                // if (in_array($i, $sel_month)) {
                $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
                // }
            }

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

            $html = view('report.daily-reports.sales-report.sale_by_branch-discount.partial', compact('branch', 'monthdiscount_check', 'allmonth', 'year'))->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }

    }

    public function HeaderTotalGrossSaleMonthly(Request $request)
    {

        //  To Fill Total Header //

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

        $total_header = '';

        $total_header .= '<th class="table_th" style="white-space: nowrap;padding:10px; color:green;">Total</th>';

        $total_sum = 0;

        foreach ($branch as $key => $brn) {
            $yearlydiscount = DailySaleReport::select('branch_id', DB::raw('Year(report_date) as year')
                , DB::raw('SUM(gross_sale) as discount'))
                ->whereYear('report_date', $request->year)
                ->where('branch_id', $key)
                ->groupBy('year', 'branch_id')
                ->first();

            $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . (@$yearlydiscount['discount'] == null ? '-' : number_format((float) @$yearlydiscount['discount'], 3, '.', '')) . '</th>';

            $total_sum = $total_sum+@$yearlydiscount['discount'];
        }

        $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . number_format((float) $total_sum, 3, '.', '') . '</th>';

        return response()->json([
            'status' => 'success',
            'total_header' => $total_header,
            'total_sum' => $total_sum,
        ]);

        //  --------------- //
    }

    public function BranchGrossSalesMonthlydownload($year)
    {

        //if (Auth::user()->can('download_sales_by_branch_discount_sale_report')) {

        $payment = new GrossSalesMonthlydownload($year);
        $payment->result();

        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    //End Gross Sale Monthly Coding ....................

    public function BranchNetSaleMonthly()
    {

      if (Auth::user()->can('sales_by_branch_net_sale_monthly_tab_management')) {

        $year = date('Y');

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

        $monthnetsales = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
            , DB::raw('SUM(net_sale) as netsales'))
            ->whereYear('report_date', $year)
            ->groupBy('month', 'branch_id')
            ->get();

        // $dailymonthdiscount = array();
        $monthnetsales_check = array();

        foreach ($monthnetsales as $key => $data) {
            // return $data['month'];
            if (!in_array($data['month'], $monthnetsales_check)) {
                // $month[] = $data['month'];
                $monthnetsales_check[$data['month']][$data['branch_id']] = $data;

            }
        }

        $allmonth = array();

        for ($i = 1; $i <= 12; $i++) {
            // if (in_array($i, $sel_month)) {
            $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
            // }
        }

        $branch_total_sum = array();

        $branch1 = array();

        return view('report.daily-reports.sales-report.sale_by_branch_net_sales_monthly.index', compact('branch', 'monthnetsales_check', 'allmonth', 'year'));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function SalesBranchFilterdNetSaleMonthly(Request $request)
    {

        try {

            if ($request->has('reset') && $request->reset != null && $request->reset != '') {
                $year = date('Y');
                Session::put('sales_by_branch_netsales_year', null);
            } else {
                $year = $request->year;
                Session::put('sales_by_branch_netsales_year', $year);
            }

            $monthnetsale = DailySaleReport::select('branch_id', DB::raw('Month(report_date) as month')
                , DB::raw('SUM(net_sale) as netsales'))
                ->whereYear('report_date', $year)
                ->groupBy('month', 'branch_id')
                ->get();

            $monthnetsales_check = array();

            foreach ($monthnetsale as $key => $data) {
                // return $data['month'];
                if (!in_array($data['month'], $monthnetsales_check)) {
                    // $month[] = $data['month'];
                    $monthnetsales_check[$data['month']][$data['branch_id']] = $data;

                }
            }

            $allmonth = array();

            for ($i = 1; $i <= 12; $i++) {
                // if (in_array($i, $sel_month)) {
                $allmonth[(int) date("m", mktime(0, 0, 0, $i, 1, date("Y")))] = date("M-Y", mktime(0, 0, 0, $i, 1, date("Y")));
                // }
            }

            $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

            $html = view('report.daily-reports.sales-report.sale_by_branch_net_sales_monthly.partial', compact('branch', 'monthnetsales_check', 'allmonth', 'year'))->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() . ' on line no ' . $e->getLine() . ' in file ' . $e->getFile(),
            ], 200);
        }

    }

    public function HeaderTotalNetSales(Request $request)
    {

        //  To Fill Total Header //

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

        $total_header = '';

        $total_header .= '<th class="table_th" style="white-space: nowrap;padding:10px; color:green;">Total</th>';

        $total_sum = 0;

        foreach ($branch as $key => $brn) {
            $yearlydiscount = DailySaleReport::select('branch_id', DB::raw('Year(report_date) as year')
                , DB::raw('SUM(net_sale) as netsales'))
                ->whereYear('report_date', $request->year)
                ->where('branch_id', $key)
                ->groupBy('year', 'branch_id')
                ->first();

            $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . (@$yearlydiscount['netsales'] == null ? '-' : number_format((float) @$yearlydiscount['netsales'], 3, '.', '')) . '</th>';

            $total_sum = $total_sum+@$yearlydiscount['netsales'];
        }

        $total_header .= '<th class="table_th" style="white-space: nowrap;padding:30px; color:green;">' . number_format((float) $total_sum, 3, '.', '') . '</th>';

        return response()->json([
            'status' => 'success',
            'total_header' => $total_header,
            'total_sum' => $total_sum,
        ]);

        //  --------------- //
    }

    public function BranchNetSalesMonthlydownload($year)
    {

        //if (Auth::user()->can('download_sales_by_branch_discount_sale_report')) {

        $payment = new NetSalesMonthlydownload($year);
        $payment->result();

        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }

    //Start Net Sale Monthly Coding ....................

//End Net Sale Monthly Coding ....................

}
