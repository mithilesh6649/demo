<?php

namespace App\Http\Controllers;

use App\Http\Reports\GenerateMaintenanceReport;
use App\Models\Branch;
use App\Models\BranchCar;
use App\Models\BranchDriver;
use App\Models\MaintenanceBalance;
use App\Models\MaintenanceCategory;
use App\Models\MaintenanceReport;
use App\Models\MaintenanceReportDoc;
use App\Models\MaintenanceSubCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class MaintenanceReportController extends Controller
{

    public function MaintenanceReportList()
    {
        if (Auth::user()->can('maintenance_report_tab_management')) {

            $all_active_branches = Branch::where("status", 1)->get();
            // $daily_gifts_card_report = PurchasedGiftCard::get();

            $selected_branch = $all_active_branches[0]->id;
            $selected_date = [
                date('d/m/Y'),
                date('d/m/Y'),
            ];

            $report_date_1 = str_replace("/", "-", $selected_date[0]);
            $report_date_1 = date('Y-m-d', strtotime($report_date_1));

            $report_date_2 = str_replace("/", "-", $selected_date[1]);
            $report_date_2 = date('Y-m-d', strtotime($report_date_2));

            $this->countDocumentReferenceNumber($all_active_branches[0]['id']);

            $daily_maintenance_report = MaintenanceReport::with('MaintenanceSubCategory')
                ->where(['branch_id' => $all_active_branches[0]['id']])
                ->where('report_date', '>=', $report_date_1)
                ->where('report_date', '<=', $report_date_2)
                ->orderBy('report_date', 'DESC')
                ->orderBy('id', 'DESC')
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->report_date)->format('Y-m-d');
                });

            // return $maintenance_report;

            $last_received_amounts = MaintenanceBalance::where(['branch_id' => $all_active_branches[0]['id']])
                ->where('report_date', '>=', $report_date_1)
                ->where('report_date', '<=', $report_date_2)
                ->where('cash_received', '!=', 0)
                ->orderBy('report_date', 'DESC')
                ->orderBy('id', 'DESC')->get();
            // return view('maintenance/index',compact('daily_report_sales'));

            return view(
                "report.maintenance-reports.index",
                compact("daily_maintenance_report", "all_active_branches", "last_received_amounts", "selected_branch", "selected_date")
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

    public function MaintenanceReportView($id)
    {
        $all_active_branches = Branch::where("status", 1)->get();
        return $gift = MaintenanceReport::with('branch', 'MaintenanceSubCategory')->where('id', $id)->first();
        return view(
            "report.maintenance-reports.view",
            compact("gift", "all_active_branches")
        );
    }

    public function MaintenanceReportDelete(Request $request)
    {

        $MaintenanceReport = MaintenanceReport::where('id', $request->id);

        $MaintenanceReport = $MaintenanceReport->delete();

        if ($MaintenanceReport) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

    public function MaintenanceReportFilter(Request $request)
    {

        if ($request->date != null && $request->date[0] != null) {

            $report_date_1 = str_replace("/", "-", $request->date[0]);
            $report_date_1 = date('Y-m-d', strtotime($report_date_1));

            $report_date_2 = str_replace("/", "-", $request->date[1]);
            $report_date_2 = date('Y-m-d', strtotime($report_date_2));

            $daily_maintenance_report = MaintenanceReport::with('MaintenanceSubCategory')
                ->where(['branch_id' => $request->branch_id])
                ->where('report_date', '>=', $report_date_1)
                ->where('report_date', '<=', $report_date_2)
                ->orderBy('report_date', 'DESC')
                ->orderBy('id', 'DESC')
                ->get()
                ->groupBy(function ($val) {
                    return Carbon::parse($val->report_date)->format('Y-m-d');
                });

            if ($request->from_filter != 'reset') {
                Session::put('maintenance_reports_start_date', $report_date_1);
                Session::put('maintenance_reports_end_date', $report_date_2);
                Session::put('maintenance_reports_branch_id', $request->branch_id);
            } else {
                Session::put('maintenance_reports_start_date', null);
                Session::put('maintenance_reports_end_date', null);
                Session::put('maintenance_reports_branch_id', null);

            }

            $result_view = view("report.maintenance-reports.maintenance-partial", [
                "daily_maintenance_report" => $daily_maintenance_report,
                "selected_branch" => $request->branch_id,
            ])->render();

            return json_encode(["html" => $result_view, "status" => true]);
        }

    }

    public function deletedMaintenanceReportList()
    {
        $branch = Branch::where('status', '1')->get()->pluck('title_en', 'id');
        $allBranchDeletedReports = MaintenanceReport::with('Branch')->onlyTrashed()->get();
        return view('report.maintenance-reports.deleted_list', compact('branch', 'allBranchDeletedReports'));
    }

    public function filterMaintenanceDeletedReports(Request $request)
    {
        $allBranchDeletedReports = null;
        if ($request->with == 'only_branch_id') {

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = MaintenanceReport::with('Branch')->onlyTrashed()->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = MaintenanceReport::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->get();
            }

            $result_view = view('report.maintenance-reports.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }

        if ($request->with == "apply_filter") {

            $first_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[0])));
            $last_second = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_range[1])));

            if ($request->branch_id == 0) {
                $allBranchDeletedReports = MaintenanceReport::with('Branch')->onlyTrashed()->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            if ($request->branch_id != 0) {
                $allBranchDeletedReports = MaintenanceReport::with('Branch')->onlyTrashed()->where('branch_id', $request->branch_id)->whereBetween('report_date', [$first_second, $last_second])->get();
            }

            $result_view = view('report.maintenance-reports.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();

            return json_encode(['html' => $result_view, 'status' => true]);

        }
    }

    public function resetMaintenanceDeletedReports(Request $request)
    {
        $allBranchDeletedReports = MaintenanceReport::with('Branch')->onlyTrashed()->get();
        $result_view = view('report.maintenance-reports.deleted_partial', ['allBranchDeletedReports' => $allBranchDeletedReports])->render();
        return json_encode(['html' => $result_view, 'status' => true]);
    }

    public function restoreMaintenanceReport(Request $request)
    {
        $selected_dates = MaintenanceReport::withTrashed()->where('id', $request->id)->restore();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    public function permanentDeleteMaintenanceReport(Request $request)
    {

        $selected_dates = MaintenanceReport::withTrashed()->where('id', $request->id)->forceDelete();
        if ($selected_dates) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }

    }

    public function countDocumentReferenceNumber($branch_id)
    {
        $maintenance_report = MaintenanceReport::where(['branch_id' => $branch_id])
            ->orderBy('report_date', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->report_date)->format('Y-m-d');
            });

        if (isset($maintenance_report)) {
            foreach ($maintenance_report as $key => $report_) {
                $count = 0;
                foreach ($report_ as $report) {
                    $count++;

                    $date = str_replace("/", "-", $report->report_date);
                    $reportdate = date('dmy', strtotime($date));

                    $branch = Branch::find($branch_id);
                    $doc_ref_update = 'ME/' . ($branch['branch_code'] ? $branch['branch_code'] : $branch['short_name']) . '-' . $reportdate . '/' . $count;
                    MaintenanceReport::where('id', $report->id)->update(['doc_ref_no' => $doc_ref_update]);

                }
            }

        }
    }

    public function maintenanceaddReceivedAmount(Request $request)
    {

        if ($request->id) {
            $received_balance = MaintenanceBalance::find($request->id);

            $new_amount = number_format($received_balance->closing_balance, 3, '.', '') + number_format($request->received_amount, 3, '.', '') - number_format($received_balance->cash_received, 3, '.', '');

            $received_balance->update([
                'cash_received' => number_format($request->received_amount, 3, '.', ''),
                'closing_balance' => $new_amount,
            ]);

            MaintenanceBalance::updateEntries($received_balance->id, $request->get_branch_id);

        } else {

            MaintenanceBalance::create([
                'branch_id' => $request->get_branch_id,
                'maintenance_report_id' => null,
                'opening_balance' => MaintenanceReport::closingBalance($request->get_branch_id, $request->get_date),
                'cash_received' => number_format($request->received_amount, 3, '.', ''),
                'expense' => 0.000,
                'closing_balance' => MaintenanceReport::closingBalance($request->get_branch_id, $request->get_date) + number_format($request->received_amount, 3, '.', ''),
                'doc_ref_no' => null,
                'report_date' => date('Y-m-d'),
            ]);
        }
        return redirect()->back();
    }

    public function MaintenanceClosingReportFilter(Request $request)
    {

        if ($request->date != null && $request->date[0] != null) {

            $report_date_1 = str_replace("/", "-", $request->date[0]);
            $report_date_1 = date('Y-m-d', strtotime($report_date_1));

            $report_date_2 = str_replace("/", "-", $request->date[1]);
            $report_date_2 = date('Y-m-d', strtotime($report_date_2));

            $last_received_amounts = MaintenanceBalance::where(['branch_id' => $request->branch_id])
                ->where('report_date', '>=', $report_date_1)
                ->where('report_date', '<=', $report_date_2)
                ->where('cash_received', '!=', 0)
                ->orderBy('report_date', 'DESC')
                ->orderBy('id', 'DESC')->get();

            $closing_balance = view("report.maintenance-reports.closing_balance_partial", [
                "selected_date" => $request->date,
                "selected_branch" => $request->branch_id,
                "last_received_amounts" => $last_received_amounts,
            ])->render();

            return json_encode([
                "closing_balance" => $closing_balance,
                "status" => true,
            ]);
        }

    }

    public function editMaintenanceReport($id)
    {

        $maintenance_data = MaintenanceReport::where(['id' => $id])->first();

        $maintenance_doc = MaintenanceReportDoc::all();

        $branch_cars = BranchCar::where('branch_id', $maintenance_data->branch_id)->where('status', BranchCar::ACTIVE)->get();

        $maintenance_images = MaintenanceReportDoc::where('maintenance_report_id', $id)->get()->toArray();

        $categories = MaintenanceCategory::where('status', 1)->get();

        $drivers = BranchDriver::where([
            'status' => BranchDriver::ACTIVE,
            'branch_id' => $maintenance_data->branch_id,
        ])->get();

        return view('report.maintenance-reports.edit', compact('maintenance_data', 'maintenance_doc', 'categories', 'maintenance_images', 'branch_cars', 'drivers', ));

    }

    public function updateMaintenanceReport(Request $request)
    {

        $Maintenance = MaintenanceReport::where('id', $request->maintenance_id)->first();
        $Maintenance->category_id = $request->category;
        $Maintenance->sub_category_id = $request->sub_category;
        $Maintenance->doc_ref_no = $request->doc_ref_no;
        $Maintenance->voucher_number = $request->voucher_number;
        $Maintenance->person_or_company_name = $request->person_or_company_name;
        $Maintenance->amount = $request->amount;
        $Maintenance->remarks = $request->remarks;
        $Maintenance->description = $request->description;

        if ($request->fuel_flag == 1 || $request->fuel_flag == '1') {

            $Maintenance->car_id = $request->vehicle_number;
            $Maintenance->driver_id = $request->driver_id;
            $Maintenance->driven_km = $request->driven_km;

        } elseif (($request->repair_flag == 1 || $request->repair_flag == '1' && ($request->fuel_flag != 1 || $request->fuel_flag != '1'))) {
            $Maintenance->car_id = $request->vehicle_number;
            $Maintenance->driver_id = $request->driver_id;
            $Maintenance->driven_km = null;
        }

        if ($Maintenance->update()) {

            MaintenanceBalance::expenseAmountUpdated($Maintenance->id);

            $data = ['type' => $request->image_type,
                'page' => str_replace(' ', '_', strtolower($request->page_name))];

            if (Session::has('DocImage') || Session::has('MaintenanceId')) {
                Session::forget('DocImage');
                Session::forget('MaintenanceId');
            }
            Session::push('DocImage', $data);
            Session::put('MaintenanceId', $Maintenance->id);
            return response()->json([
                'success' => true,
                'status' => 'success',
            ]);

            // return redirect()->route('maintenance')->with("success", "Maintenance report  has been updated successfully!");

        }

    }

    public function maintenance_doc_image_save(Request $request)
    {

        $docdata = Session::get('DocImage');

        $maintenance_id = Session::get('MaintenanceId');

        $get_maintenance_data = MaintenanceReport::where('id', $maintenance_id)->first();

        $proimages = $request->file('file');

        for ($i = 0; $i < count($proimages); $i++) {
            $image_path = $proimages[$i]->getClientOriginalName();
            $proimages[$i]->move(env('BRANCH_PORTAL_MAINTENANCE_DOC_PATH'), $image_path);

            $DocImage = MaintenanceReportDoc::create([
                'branch_id' => $get_maintenance_data->branch_id,
                'user_id' => $get_maintenance_data->user_id,
                'maintenance_report_id' => $maintenance_id,
                'doc' => $image_path,
            ]);
        }
        //  BannerImage::where('page_name',$bannerdata[0]['page'])->update(['type'=>$bannerdata[0]['type'] ]);

        if (Session::has('DocImage') || Session::has('MaintenanceId')) {
            Session::forget('DocImage');
            Session::forget('MaintenanceId');
        }

        return 'success';
    }

    public function viewMaintenanceReport($id)
    {

        $maintenance_data = MaintenanceReport::where(['id' => $id])->first();

        $maintenance_doc = MaintenanceReportDoc::where('maintenance_report_id', $id)->get();

        return view('report.maintenance-reports.view', compact('maintenance_data', 'maintenance_doc'));

    }

    public function deletedByid(Request $request)
    {
        $delval = MaintenanceReportDoc::where('id', $request->document_image_id)->forceDelete();
        $data = MaintenanceReportDoc::where('maintenance_report_id', $request->maintenance_id)->get();
        return response()->json([
            'success' => true,
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function deleteMaintenanceReport(Request $request)
    {
        $MaintenanceReport = MaintenanceReport::where('id', $request->id);

        $MaintenanceReport = $MaintenanceReport->delete();

        if ($MaintenanceReport) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }

    public function getUpdateData(Request $request)
    {
        $doc_images = MaintenanceReportDoc::where('maintenance_report_id', $request->id)->get();

        return response()->json([
            'success' => true,
            'data' => $doc_images,
            'status' => 'success',

        ]);
    }

    public function maintenance_sub_category(Request $request)
    {

        $sub_categories = MaintenanceSubCategory::where('cat_id', $request->cat_id)->get();

        return response()->json(['sub_categories' => $sub_categories, "status" => true]);

    }

    public function downloadMaintenanceReport($branch_id = null, $date = null)
    {
        // if (Auth::user()->can('download_sales_petty_report')) {

        if ($date != null) {

            $date = base64_decode($date);

            $date = explode(',', $date); //For breaking dates //

            $date = array_map('trim', $date); // For removing any space //

            $obj = new GenerateMaintenanceReport($branch_id, $date);
            return $obj->result();
        }

        // } else {
        //     return redirect()
        //         ->route("dashboard")
        //         ->with(
        //             "warning",
        //             "You do not have permission for this action!"
        //         );
        // }
    }


    public function downloadMaintenanceReportPdfAll(Request $request)
    {
        
        $branch_id = $request->branch_id;
        $report_date_1 = str_replace("/", "-", $request->date[0]);
        $report_date_1 = date('Y-m-d', strtotime($report_date_1));

        $report_date_2 = str_replace("/", "-", $request->date[1]);
        $report_date_2 = date('Y-m-d', strtotime($report_date_2));

        $imageUrl = $request->imageUrl;

       $daily_maintenance_reports = MaintenanceReport::with('sub_category','MaintenanceReportDoc','branch')
        ->where(['branch_id' => $branch_id])
        ->where('report_date', '>=', $report_date_1)
        ->where('report_date', '<=', $report_date_2)
        ->orderBy('report_date', 'ASC')
        ->orderBy('id', 'ASC')
        ->get();
       
        $branch = Branch::find($branch_id);
        
         $pdf = \PDF::loadView('report.maintenance-reports.maintenance-pdf-preview-all', compact('daily_maintenance_reports','imageUrl'))->setPaper(array(0, 0, 700, 792), 'landscape');

           return $pdf->download('Maintenance.pdf');  

       
   
    }



    public function downloadMaintenanceInvoice($report_id = null, $branch_id = null)
    {

        try {

            $datas = MaintenanceReport::where('id', $report_id)->get();
            $branch = Branch::find($branch_id);

            $pdf = \PDF::loadView('report.maintenance-reports.maintenance-invoice-preview', compact('datas'))->setPaper(array(0, 0, 612, 792), 'landscape');
            return $pdf->download('Maintenance-' . $branch->short_name . '-' . date('d-m-Y', strtotime(base64_decode($datas[0]->report_date))) . '.pdf');

        } catch (\Exception $e) {
            return $e->getMessage() . ' on line no. ' . $e->getLine() . ' in file ' . $e->getFile();
        }
        return base64_decode($report_id);

    }

    public function PreviewMaintenance(Request $request)
    {
        //   dd($request->all());
        $maintenance_docs = MaintenanceReportDoc::where('maintenance_report_id', $request->id)->get()->toArray();
        $maintenance_docs_count = MaintenanceReportDoc::where('maintenance_report_id', $request->id)->get('doc')->count();

        $result_view = view("report.maintenance-reports.maintenance_doc_preview", [
            "maintenance_docs" => $maintenance_docs,
            "maintenance_docs_count" => $maintenance_docs_count,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);
    }

}
