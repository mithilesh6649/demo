<?php

namespace App\Observers;

use App\Models\WebUserTicketAssociation;
use App\Models\GroupChatUser;
use App\Models\Notification;
use App\Models\MdDropdown;
use App\Models\UserReport;
use App\Models\GroupChat;
use App\Models\Message;
use App\Models\Ticket;

class UserReportObserver
{
    /**
     * Handle the UserReport "created" event.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return void
     */
    public function created(UserReport $userReport)
    {
        if ($userReport->user_test_id == null) {

            if ($userReport->document_type == config('common.models.user_reports.document_type.organ_report') && $userReport->uploaded_by_guard == config('common.guards.users')) {

                $notification = new Notification;
                $newTicket = new Ticket;
                $newGroupChat = new GroupChat;

                $alreadyExists = Ticket::where(['ticket_owner_id' => auth()->id(), 'ticket_owner_guard' => 'users', 'ticket_type' => 1])->whereNotNull('ticket_assigned_to_guard')->whereNotNull('ticket_assigned_to')->first();

                if ($alreadyExists) {

                    $ticketAssigned = new WebUserTicketAssociation;

                    $newTicket->ticket_assigned_to_guard = $alreadyExists->ticket_assigned_to_guard;
                    $newTicket->ticket_assigned_to = $alreadyExists->ticket_assigned_to;
                    $notification->notification_to = $alreadyExists->ticket_assigned_to;

                    $ticketAssigned->gena_health_user_guard = $alreadyExists->ticket_assigned_to_guard;
                    $ticketAssigned->ticket_assigned_date = now();
                    $ticketAssigned->gena_health_user_id = $alreadyExists->ticket_assigned_to;
                    $ticketAssigned->is_blocked = 0;
                }

                $notification->notification_template_id = 11;
                $newTicket->unique_ticket_id = now()->timestamp;
                $notification->notification_to_guard = config('common.guards.web_users');
                $newTicket->user_report_id = $userReport->id;
                $newTicket->ticket_owner_id = auth()->id();
                $newTicket->ticket_owner_guard = config('common.guards.users');
                $newTicket->status_id = 10;
                $newTicket->category = config('common.models.tickets.category.1');
                $newTicket->priority = 'high';
                $newTicket->ticket_type = config('common.models.tickets.ticket_type.report');
                $newTicket->save();

                //Saving Ticket assigned to web users
                if ($alreadyExists) {

                    $ticketAssigned->ticket_id = $newTicket->id;
                    $ticketAssigned->save();
                }

                //Saving notifications to user
                $notification->save();
                $newGroupChat->ticket_id = $newTicket->id;

                if($newGroupChat->save()) {

                    //Creating a chat group for a new ticket
                    $groupChatUser = new GroupChatUser;
                    $groupChatUser->gena_health_user_guard = config('common.guards.users');
                    $groupChatUser->gena_health_user_id = auth()->id();
                    $groupChatUser->group_chat_id = $newGroupChat->id;

                    $groupChatUser->save();

                    Message::createDummyMessage($newGroupChat->id, $newTicket->ticket_type);
                }
            }
        }
    }

    /**
     * Handle the UserReport "updated" event.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return void
     */
    public function updated(UserReport $userReport)
    {
        //
    }

    /**
     * Handle the UserReport "deleted" event.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return void
     */
    public function deleted(UserReport $userReport)
    {
        if($ticket = Ticket::where(['user_report_id' => $userReport->id, 'ticket_owner_id' => $userReport->user_id, 'ticket_owner_guard' => config('common.guards.users')])->first()) {

            $ticket->delete();
        }
    }

    /**
     * Handle the UserReport "restored" event.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return void
     */
    public function restored(UserReport $userReport)
    {
        //
    }

    /**
     * Handle the UserReport "force deleted" event.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return void
     */
    public function forceDeleted(UserReport $userReport)
    {
        //
    }
}
