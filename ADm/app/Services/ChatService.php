<?php

namespace App\Services;

use App\Http\Resources\TicketResource;
use App\Models\GroupChat;
use App\Models\Ticket;
use DB, Log;

class ChatService {

    /**
     * Function: getMessages
     * Functionality: This Fnc will check if ticket_id presents
     * then it will fetch the records of that particular tickets
     * otherwise create new tikcet
     *
     * @return array
     */
    public function getMessages(): array
    {
        try {
            DB::beginTransaction();

            $paginateOffset = (request()->has('page')) ? (request()->page * 20) - 20 : 0;
            $ticketId = request()->ticket_id;

            if (!request()->has('ticket_id')) {

                $ticketAlreadyExist = Ticket::alreadyExists();

                if (is_null($ticketAlreadyExist)) {

                    $ticketId = Ticket::createNewTicket(request()->ticket_type);
                    $createNewChatGroup = GroupChat::createChatGroup($ticketId);

                } else {

                    $ticketId = $ticketAlreadyExist->id;
                }
            }

            $ticketInfo = Ticket::whereId($ticketId)->with('ticketmessages.messages', function ($qr) use ($paginateOffset) {
                return $qr->offset($paginateOffset)->limit(30);
            })->first();

            DB::commit();

            return ['status' => 200, 'success' => true, 'data' => ($ticketInfo == null) ? [] : new TicketResource($ticketInfo), 'error' => false];

        } catch (\Exception $e) {

            Log::debug(["something bad happened while getting Message" => $e]);
            DB::rollBack();

            return ['status' => 400, 'success' => false, 'message' => 'Something went wrong', 'error' => true];
        }
    }
}
