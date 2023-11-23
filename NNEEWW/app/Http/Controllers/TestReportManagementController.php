<?php

namespace App\Http\Controllers;

use App\Models\Nutritionist;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\UserReport;
use App\Models\UserTest;
use Auth,DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestReportManagementController extends Controller
{
    public function TestList()
    {
        if (Auth::user()->can('genetic_test_reports_management')) {
        $allTickets = Ticket::with('userTest.test', 'status')->where('ticket_type', Ticket::TestType)->orderBy('status_id')->get();
        $allNutritionists = Nutritionist::ACTIVE_NUTRITIONIST();
        return view("test_reports.list", compact("allTickets", "allNutritionists"));
         } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function assignReport(Request $request)
    {
        $getTicket = Ticket::where('id', $request->id)->first();
        $getTicket->ticket_assigned_to = $request->nutritionist_id;
        $getTicket->ticket_assigned_to_guard = 'web_users';
        $getTicket->status_id = Status::where('slug', 'ticket_closed')->value('id');
        $getTicket->update();
        return response()->json([
            'success' => 1,
        ]);
    }

    public function getReportData(Request $request)
    {

        $userTestLists = UserTest::with('test')->where('payment_transaction_id', $request->transaction_id)->get();
        $result_view = view('test_reports.partial', ['userTestLists' => $userTestLists])->render();
        return json_encode(['html' => $result_view, 'status' => true]);
    }

   //  public function uploadReportData(Request $request)
   //  {
   //      // DB::beginTransaction();
   //      // try
   //      // {

   //      if ($request->hasFile('test_reports')) {
   //          $files = $request->file('test_reports');
   //          foreach ($files as $key => $file) {
   //              $thumbnail = $key . "." . time() . "." . $file->getClientOriginalExtension();
   //              $fullUrl = $file->move("images/user_reports", $thumbnail);
   //              $mainUrl = env('IMAGE_BASE_URL') . '/' . $fullUrl;
   //              $data = [
   //                  'report_no' => Str::lower(Str::random(10)),
   //                  'user_test_id' => $request['user_test_id'][$key],
   //                  'user_id' => $request->user_id,
   //                  'test_id' => $request['test_id'][$key],
   //                  'document_url' => $mainUrl,
   //                  'uploaded_by' => Auth::user()->id,
   //                  'uploaded_by_guard' => 'clinicians',
   //                  'document_type' => 2, //test_report
   //              ];

   //              UserReport::updateOrCreate(
   //                  ['user_test_id' => $request['user_test_id'][$key]],
   //                  $data
   //              );
   //              //Update user_tests || test_done :- column
   //              UserTest::where('id', $request['user_test_id'][$key])->update([
   //                  'test_done' => 1,
   //              ]);

   //          }

   //          //    }

   //          // return redirect()
   //          //                ->route("test_reports_list")
   //          //                ->with("success", "Test has been uploaded successfully!");
   //          //    DB::commit();
   //          // } catch (\Exception $e) {
   //          //  DB::rollback();
   //          //  return redirect()->route("test_reports_list")
   //          //  ->with("error", "something went wrong");
   //      }

   //  }


   public function uploadReportData(Request $request)
{
    DB::beginTransaction();
    try
    {
        if ($request->hasFile('test_reports')) {
            $files = $request->file('test_reports');
            foreach ($files as $key => $file) {
                $thumbnail = $key . "." . time() . "." . $file->getClientOriginalExtension();
                $fullUrl = $file->move("images/user_reports", $thumbnail);
                $mainUrl = env('IMAGE_BASE_URL') . '/' . $fullUrl;
                $data = [
                    'report_no' => Str::lower(Str::random(10)),
                    'user_test_id' => $request['user_test_id'][$key],
                    'user_id' => $request->user_id,
                    'test_id' => $request['test_id'][$key],
                    'document_url' => $mainUrl,
                    'uploaded_by' => Auth::user()->id,
                    'uploaded_by_guard' => 'clinicians',
                    'document_type' => 2, //test_report
                ];

                UserReport::updateOrCreate(
                    ['user_test_id' => $request['user_test_id'][$key]],
                    $data
                );
                //Update user_tests || test_done :- column
                UserTest::where('id', $request['user_test_id'][$key])->update([
                    'test_done' => 1,
                ]);

            }
        }

        DB::commit();
        return redirect()
                        ->route("test_reports_list")
                        ->with("success", "Test has been uploaded successfully!");
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->route("test_reports_list")
        ->with("error", "something went wrong");
    }

}


}
