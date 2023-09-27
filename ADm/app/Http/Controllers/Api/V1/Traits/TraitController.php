<?php

namespace App\Http\Controllers\Api\V1\Traits;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\TraitService;
use Illuminate\Http\Request;

class TraitController extends Controller
{

    protected $traitService;

    public function __construct (TraitService $traitService)
    {
        $this->traitService = $traitService;
    }

    /**
     * Function: index
     * Functionality: This Fnc will fetch the listing of the traits
     * categories
     *
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function index()
    {
        $response = $this->traitService->traitCategoryList();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: listing
     * Functionality: This Fnc will fetch the listing of the traits
     * according to their category
     *
     * @param array $traitCategoryId
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function listing()
    {
        $categoriesIds = (str_contains(request()->trait_category_ids, ',')) ? explode(',', request()->trait_category_ids) : (array) request()->trait_category_ids;
        request()->request->add(['trait_category_ids' => $categoriesIds]);

        $response = $this->traitService->traitList();

        return Response::json($response, $response['status']);
    }
}
