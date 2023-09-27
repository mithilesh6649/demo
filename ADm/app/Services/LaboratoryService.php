<?php

namespace App\Services;

use App\Http\Resources\LaboratoryResource;
use App\Models\Laboratory;

class LaboratoryService
{
    protected $laboratory;

    public function __construct(Laboratory $laboratory)
    {
        $this->laboratory = $laboratory;
    }

    public function getLabData($labId)
    {
        $laboratory = $this->laboratory->where(['id' => $labId, 'status' => 1])->with('metadata')->first();

        if ($laboratory) {

            $labs = new LaboratoryResource($laboratory);

            return ['status' => 200, 'success' => true, 'data' => $labs, 'error' => false];
        }

        return ['status' => 400, 'success' => false, 'message' => 'Laboratory not found!', 'error' => true];
    }
}
