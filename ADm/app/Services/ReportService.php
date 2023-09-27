<?php

namespace App\Services;

use App\Http\Resources\OrganTestResource;
use App\Models\UserReport;

class ReportService
{
    /**
     * Function: getTestReports
     * Functionality: Fetch all test reports
     *
     * @return array
     *
     */
    public function getTestReports()
    {
        $userTestReport = auth()->user()->testReports();

        return ['status' => 200, 'success' => true, 'data' => $userTestReport, 'error' => false];
    }

    /**
     * Function: getOrganReports
     * Functionality: Fetch all organ test reports
     *
     * @return array
     *
     */
    public function getOrganReports()
    {
        $userOrganReport = auth()->user()->organReports();

        return ['status' => 200, 'success' => true, 'data' => OrganTestResource::collection($userOrganReport), 'error' => false];
    }

    /**
     * Function: destroyReport
     * Functionality: Delete particular report with the ticket
     * associated with it.
     *
     * @return array
     *
     */
    public function destroyReport()
    {
        $userReport = new UserReport;
        $userReport->destroyReport();

        return ['status' => 200, 'success' => true, 'message' => 'Report deleted successfully', 'error' => false];
    }
}
