<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\DocumentRequest;
use App\Http\Traits\UploadFileTrait;
use App\Services\ReportService;
use Illuminate\Http\Request;
use App\Models\UserReport;
use App\Models\Ticket;

class ReportController extends Controller
{
    use UploadFileTrait;

    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Function: save
     * Functionality: This fnc will upload the reports uploaded by the
     * user
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function save(Request $request)
    {

        $docURL = $this->uploadMedia($request);

        if ($docURL) {

            $report = new UserReport;
            $report->document_url = $docURL;
            $report->user_id = auth()->id();
            $report->document_type = $request->report_type;
            $report->test_id = $request->test_id;
            $report->report_no = now()->timestamp;

            $report->save();

            $testData = [
                'test_id' => $report->id,
                'document_url' => $docURL,
                'ticket_id' => Ticket::where('user_report_id', $report->id)->value('id'),
            ];


            return Response::json(['status' => 200, 'success' => true, 'message' => 'Document successfully Uploaded', 'test' => $testData, 'error' => false], 200);
        }

        return Response::json(['status' => 400, 'success' => false, 'message' => 'Something went wrong while uploading document', 'error' => true], 400);
    }

    /**
     * Function: reports
     * Functionality: This fnc will fetch the user's test reports
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function reports(Request $request)
    {
        $response = $this->reportService->getTestReports();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: getAllReports
     * Functionality: This fnc will fetch the user's all test reports
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function getAllReports(Request $request)
    {
        $response = $this->reportService->getOrganReports();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: destroyReport
     * Functionality: This fnc will delete the particular report of the
     * user, as well as tickets related to that reports.
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function destroyReport(Request $request)
    {
        $response = $this->reportService->destroyReport();

        return Response::json($response, $response['status']);
    }
}
