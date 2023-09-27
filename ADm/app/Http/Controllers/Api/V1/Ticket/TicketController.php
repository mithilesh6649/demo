<?php

namespace App\Http\Controllers\Api\V1\Ticket;

use Illuminate\Support\Facades\Response;
use App\Http\Resources\TicketResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return Response::json(['status' => 200, 'success' => true, 'data' => TicketResource::collection(auth()->user()->tickets()), 'error' => false]);
    }
}
