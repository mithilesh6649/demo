<?php

namespace App\Http\Controllers;

use App\Http\Reports\salesreport\BranchGiftCardsSales;
use App\Http\Reports\salesreport\GiftCardReport;
use App\Models\Branch;
use App\Models\DailySaleReport;
use App\Models\GiftCard;
use App\Models\GiftCardsType;
use App\Models\PurchasedGiftCard;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;

class GiftCardReportController extends Controller
{
    public function GiftCardsReportList()
    {
        if (Auth::user()->can('gift_card_child_tab_management')) {
            $all_active_branches = Branch::where("status", 1)->get();

            $selected_branch = $all_active_branches[0]->id;
            $selected_date = [
                date('d/m/Y'),
                date('d/m/Y'),
            ];

            $report_date_1 = date('Y-m-d', strtotime(str_replace("/", "-", $selected_date[0])));

            $report_date_2 = date('Y-m-d', strtotime(str_replace("/", "-", $selected_date[1])));

            $daily_gifts_card_report = PurchasedGiftCard::
                where('branch_id', $all_active_branches[0]['id'])
                ->where('date', '>=', $report_date_1)
                ->where('date', '<=', $report_date_2)
                ->orderByDesc("date")
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->date)->format('Y-m-d');
                });
            // $daily_gifts_card_report = PurchasedGiftCard::get();

            return view(
                "report.gift-cards-reports.index",
                compact("daily_gifts_card_report", "all_active_branches")
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

    public function GiftCardsReportFilter(Request $request)
    {

        $all_active_branches = Branch::where("status", 1)->get();

        $report_date_1 = date('Y-m-d', strtotime(str_replace("/", "-", $request->date[0])));

        $report_date_2 = date('Y-m-d', strtotime(str_replace("/", "-", $request->date[1])));

        if ($request->from_filter != 'reset') {
            Session::put('gift_cards_report_start_date', $report_date_1);
            Session::put('gift_cards_report_end_date', $report_date_2);
            Session::put('gift_cards_report_branch_id', $request->branch_id);
        } else {
            Session::put('gift_cards_report_start_date', null);
            Session::put('gift_cards_report_end_date', null);
            Session::put('gift_cards_report_branch_id', null);

        }

        $daily_gifts_card_report = PurchasedGiftCard::
            where("branch_id", $request->branch_id)
            ->where('date', '>=', $report_date_1)
            ->where('date', '<=', $report_date_2)
            ->orderByDesc("date")
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->date)->format('Y-m-d');
            });

        $result_view = view("report.gift-cards-reports.gift-cards-partial", [
            "daily_gifts_card_report" => $daily_gifts_card_report,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function GiftCardsReportView($id)
    {
        if (Auth::user()->can('view_gift_card_report')) {

            $all_active_branches = Branch::where("status", 1)->get();
            $gift = PurchasedGiftCard::with('branch')->where('id', $id)->first();
            return view(
                "report.gift-cards-reports.view",
                compact("gift", "all_active_branches")
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

    public function GiftCardsReportDelete(Request $request)
    {

        DB::beginTransaction();

        try {

            $PurchasedGiftCard = PurchasedGiftCard::where('id', $request->id)->first();
            $totalGiftCardNumber = json_decode($PurchasedGiftCard->card_number);

            foreach ($totalGiftCardNumber as $GiftCardNumber) {
                $newGifCard = GiftCard::where("card_number", $GiftCardNumber)->first();
                $newGifCard->status = 1;
                $newGifCard->is_gift_card_used = 0;
                $newGifCard->update();
            }

            $PurchasedGiftCard = $PurchasedGiftCard->forceDelete();
            DB::commit();
            if ($PurchasedGiftCard) {
                $res['success'] = 1;
                return json_encode($res);
            } else {
                $res['success'] = 0;
                return json_encode($res);
            }

        } catch (\Exception $e) {
            DB::rollback();
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function deletedGiftCardsReportList()
    {
        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');
        $allBranchDeletedReports = PurchasedGiftCard::with('Branch')->onlyTrashed()->get();
        return view('report.gift-cards-reports.deleted_list', compact('branch', 'allBranchDeletedReports'));
    }

    public function filterGiftCardsDeletedReports(Request $request)
    {
        $allBranchDeletedReports = null;
        if ($request->with == 'only_branch_id') {

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = PurchasedGiftCard::with('Branch')->onlyTrashed()->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = PurchasedGiftCard::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->get();
            }

            $result_view = view('report.gift-cards-reports.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

        if ($request->with == "apply_filter") {

            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = PurchasedGiftCard::with('Branch')->onlyTrashed()->whereBetween('date', [$first_second, $last_second])->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = PurchasedGiftCard::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->whereBetween('date', [$first_second, $last_second])->get();
            }

            $result_view = view('report.gift-cards-reports.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }
    }

    public function resetGiftCardsDeletedReports(Request $request)
    {
        $allBranchDeletedReports = PurchasedGiftCard::with('Branch')->onlyTrashed()->get();
        $result_view = view('report.gift-cards-reports.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();
        return json_encode(['html' => $result_view, 'status' => true]);
    }

    public function restoreGiftCardsReport(Request $request)
    {
        $selected_dates = PurchasedGiftCard::withTrashed()->where('id', $request->id)->restore();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function permanentDeleteGiftCardsReport(Request $request)
    {

        $selected_dates = PurchasedGiftCard::withTrashed()->where('id', $request->id)->forceDelete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function GiftCardsReportEdit($id)
    {
          if (Auth::user()->can('edit_gift_card_report')) {
        $gift = PurchasedGiftCard::where('id', $id)->first();
        return view('report.gift-cards-reports.edit', compact('gift'));
        } else {
           return redirect()
               ->route("dashboard")
               ->with(
                   "warning",
                   "You do not have permission for this action!"
               );
         }
    }

    public function GiftCardsReportUpdate(Request $request) 
    {
        $purchased_gift_card = PurchasedGiftCard::where('id', $request->gift_id)->first();
        $purchased_gift_card->guest_name = $request->guest_name;
        $purchased_gift_card->mobile_number = $request->mobile_number;
        $purchased_gift_card->pos_invoice_number = $request->pos_invoice_no;
        $purchased_gift_card->card_amount = $request->card_amount;
        $purchased_gift_card->update();
        return redirect()->route("gift.card.report.list")->with(["success" => "  Gift Cards Report updated successfully!"]);
    }

    public function GiftCardsNumberDelete(Request $request)
    {

        $gift_card = GiftCard::where(['card_number' => $request->data_card_number, 'status' => 0, 'is_gift_card_used' => 1])->first();

        $value_of_deleted_gift_card = GiftCardsType::where('id', $gift_card->gift_cards_type_id)->value('name');

        $allPurchsedGiftCardsAfterDelete = array();
        $PurchasedGiftCard = PurchasedGiftCard::where('id', $request->data_gift_card_id)->first();
        $allPurchsedGiftCardsArray = json_decode($PurchasedGiftCard->card_number);
        $currentCardAmount = $PurchasedGiftCard->card_amount - $value_of_deleted_gift_card;

        // dd($currentCardAmount);
        foreach ($allPurchsedGiftCardsArray as $key => $PurchasedGiftCardNumber) {
            if ($PurchasedGiftCardNumber == $request->data_card_number) {
                $gift_card->status = 1;
                $gift_card->is_gift_card_used = 0;
                $gift_card->update();
            } else {
                array_push($allPurchsedGiftCardsAfterDelete, $PurchasedGiftCardNumber);
            }
        }

        $PurchasedGiftCard->card_number = json_encode($allPurchsedGiftCardsAfterDelete);
        $PurchasedGiftCard->card_amount = $currentCardAmount;
        if ($PurchasedGiftCard->save()) {
            return response()->json([
                'status' => 1,
                'card_amount' => $currentCardAmount,
            ]);
        }
    }

    public function GiftCardsNumberValid(Request $request)
    {
        $card_number = $request->data_card_number;
        $gift_card = GiftCard::where(['card_number' => $card_number, 'status' => 1, 'is_gift_card_used' => 0])->first();
        if ($gift_card != null) {
            return response()->json([
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'status' => 0,
            ]);
        }

    }

    public function GiftCardsNumberUpdate(Request $request)
    {
         //dd($request->all());
        $PurchasedGiftCard = PurchasedGiftCard::where('id', $request->id)->first();
        $sum = 0;
        $PurchasedGiftCard->card_number = json_encode(array_filter($request->data_card_numbers));
        if ($PurchasedGiftCard->update()) {

            foreach ($request->data_card_numbers as $key => $PurchasedGiftCardNumber) {
                $GiftCards = GiftCard::where('card_number', $PurchasedGiftCardNumber)->first();
                $GiftCards->status = 0;
                $GiftCards->is_gift_card_used = 1;
                $GiftCards->update();
                $value_of_deleted_gift_card = GiftCardsType::where('id', $GiftCards->gift_cards_type_id)->value('name');
                $sum = $sum + $value_of_deleted_gift_card;

            }

            $PurchasedGiftCard->card_amount = $sum;
            $PurchasedGiftCard->update();

            return response()->json([
                'status' => 1,
                'card_amount' => $sum,
            ]);

        }

    }

    public function GiftCardsPurchasedShow(Request $request)
    {

        $gift = PurchasedGiftCard::where('id', $request->id)->first();

        $result_view = view("report.gift-cards-reports.gift_card_purchased", [
            "gift" => $gift,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function downloadgiftcardReport($branch_id = null, $date = null)
    {
        if ($date != null) {

            $date = base64_decode($date);

            $date = explode(',', $date); //For breaking dates //

            $date = array_map('trim', $date); // For removing any space //

            $obj = new GiftCardReport($branch_id, $date);
            return $obj->result();
        }
    }

    // Start Gift Cards Reports By all Branches

    public function BranchGiftCardsList()
    { 

          if (Auth::user()->can('gift_card_branch_all_child_tab_management')) {

        // $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
        //     , DB::raw('knet as knet') , DB::raw('printed_gift_card as printed_gift_card')  , DB::raw('e_gift_card as e_gift_card'))
        //     ->orderBy('date', 'ASC')  gift_card_branch_all_child_tab_management
        //     ->groupBy('date','knet','printed_gift_card','e_gift_card', 'branch_id')
        //     ->get();

        $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
            , DB::raw('SUM(net_sale) as net_sale'), DB::raw('printed_gift_card as printed_gift_card'), DB::raw('e_gift_card as e_gift_card'))
            ->orderBy('date', 'ASC')
            ->groupBy('date', 'printed_gift_card', 'e_gift_card', 'branch_id')
            ->get();

        $salesbranch = array();

        foreach ($data as $value_bank) {
            $salesbranch[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
        }

        $branch = Branch::where('status', '1')->get()->pluck('short_name', 'id');

        return view('report.sale_by_branch_gift_cards.index', compact('branch', 'salesbranch'));

         } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }

    }

    public function BranchGiftCardsFilter(Request $request)
    {
        $report_date_1 = str_replace("/", "-", $request->date_range[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $request->date_range[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

            if($request->from_filter != 'reset')
            {
                Session::put('gift_card_all_branch_start_dates',$report_date_1);
                Session::put('gift_card_all_branch_end_dates',$report_date_2);

            }else{
                Session::put('gift_card_all_branch_start_dates',null);
                Session::put('gift_card_all_branch_end_dates',null);

            }

        // }

        // $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
        //     , DB::raw('SUM(net_sale) as net_sale'))
        //     ->where('report_date', '>=', $report_date_1)
        //     ->where('report_date', '<=', $report_date_2)
        //     ->orderBy('date', 'ASC')
        //     ->groupBy('date', 'branch_id')
        //     ->get();

        // $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
        //     , DB::raw('SUM(net_sale) as net_sale'))
        //     ->where('report_date', '>=', $report_date_1)
        //     ->where('report_date', '<=', $report_date_2)
        //     ->orderBy('date', 'ASC')
        //     ->groupBy('date', 'branch_id')
        //     ->get();

        // $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
        //     , DB::raw('knet as knet') , DB::raw('printed_gift_card as printed_gift_card')  , DB::raw('e_gift_card as e_gift_card'))
        //     ->orderBy('date', 'ASC')
        //     ->groupBy('date','knet','printed_gift_card','e_gift_card', 'branch_id')
        //     ->get();

        $data = DailySaleReport::select('branch_id', DB::raw('DATE(report_date) as date')
            , DB::raw('SUM(net_sale) as net_sale'), DB::raw('printed_gift_card as printed_gift_card'), DB::raw('e_gift_card as e_gift_card'))
            ->where('report_date', '>=', $report_date_1)
            ->where('report_date', '<=', $report_date_2)
            ->orderBy('date', 'ASC')
            ->groupBy('date', 'printed_gift_card', 'e_gift_card', 'branch_id')
            ->get();

        $salesbranch = array();

        foreach ($data as $value_bank) {
            $salesbranch[date('d-m-Y', strtotime($value_bank->date))][$value_bank->branch_id] = $value_bank;
        }

        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');

        $html = view('report.sale_by_branch_gift_cards.partial', compact('branch', 'salesbranch'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,

        ]);

    }

    public function BranchGiftCardsDownload($start = null, $end = null)
    {
         if (Auth::user()->can('download_gift_cards_all_branch_report')) {
        $payment = new BranchGiftCardsSales($start, $end);
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

    // End Gift Cards Reports By all Branches

}
