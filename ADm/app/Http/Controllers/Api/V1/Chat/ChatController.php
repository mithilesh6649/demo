<?php

namespace App\Http\Controllers\Api\V1\Chat;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * Function: messages
     * Functionality: This Fnc will get the tikcet information with
     * its messages
     *
     * @param Illuminate\Http\Request;
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function messages(Request $request)
    {
        $response = $this->chatService->getMessages();

        return Response::json($response, $response['status']);
    }
}
