<?php

namespace App\Http\Controllers;

use App\Models\GroupChat;
use App\Models\GroupChatUser;
use App\Models\Nutritionist;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\TicketAssignedToWebUser;
use App\Models\WebUserAssociation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
class TicketsController extends Controller
{

    public function ticketsList()
    {
          if (Auth::user()->can('help_and_support_management')) {
        $ticket_type_ids = [1, 2, 3 , 4, 6, 7, 8, 9, 10, 11, 12];
        $ticketsList = Ticket::with('status', 'user', 'nutritionist')->orderBy('status_id', 'ASC')->whereIn('ticket_type', $ticket_type_ids)->orderByDesc('id')->get();
        $activeNutiritionist = Nutritionist::ACTIVE_NUTRITIONIST();
        // / dd($ticketsList);
        return view('ticket.list', ['allTickets' => $ticketsList, 'activeNutiritionist' => $activeNutiritionist]);

        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function editTicket($id)
    {
        $ticketEdit = Ticket::with('user')->orderByDesc('id')->where('id', $id)->first();
        $activeNutiritionist = Nutritionist::ACTIVE_NUTRITIONIST();
        // dd($ticketsList);
        return view('ticket.edit', ['data' => $ticketEdit, 'nutiritionists' => $activeNutiritionist]);
    }

    public function update(Request $request)
    {
        //dd($request->all());
        //Assign Ticket DIET PLAN .........
         
         $ticket = Ticket::where('id', $request->ticket_id)->first();
 
         if($ticket->ticket_type==3){

            $ticket->status_id = $request->status;
            $ticket->priority = $request->priority;
            $ticket->ticket_assigned_to = $request->ticket_assigned_to;
            $ticket->ticket_assigned_to_guard = 'web_users';
            $ticket->update();

            WebUserAssociation::updateOrCreate(['user_id'=>$ticket->ticket_owner_id],['web_user_id'=>$request->ticket_assigned_to,'type'=>2]);

            Notification::StoreNotificaiton(13,$request->ticket_assigned_to, 'web_users', Auth::user()->id, 'admin', 0); 

             return redirect()->route('ticket_list')->with(['success' => 'Ticket  has been updated successfully!']);
             dd('dd');

            // 
         }




        //End Assign Ticket DIET PLAN .........

         if($ticket->ticket_type==1 || $ticket->ticket_type==4 || $ticket->ticket_type==5 || $ticket->ticket_type==6 ){
            WebUserAssociation::updateOrCreate(['user_id'=>$ticket->ticket_owner_id],['web_user_id'=>$request->ticket_assigned_to,'type'=>2]);

            Notification::StoreNotificaiton(13,$request->ticket_assigned_to, 'web_users', Auth::user()->id, 'admin', 0); 
        }

       // $ticket = Ticket::where('id', $request->ticket_id)->first();
        $previous_ticket_assign = $ticket->ticket_assigned_to;
        if ($ticket->ticket_assigned_to == null && $ticket->ticket_assigned_to_guard == null) {

            $ticket->status_id = $request->status;
            $ticket->priority = $request->priority;
            $ticket->ticket_assigned_to = $request->ticket_assigned_to;
            $ticket->ticket_assigned_to_guard = 'web_users';
            $ticket->update();

            //Insert Records in TicketAssignedToWebUser table......
            $TicketAssignedToWebUser = new TicketAssignedToWebUser();
            $TicketAssignedToWebUser->ticket_id = $request->ticket_id;
            $TicketAssignedToWebUser->gena_health_user_id = $request->ticket_assigned_to;
            $TicketAssignedToWebUser->gena_health_user_guard = 'web_users';
            $TicketAssignedToWebUser->ticket_assigned_date = now();
            $TicketAssignedToWebUser->save();

            //Insert Records in GroupChat table......
            $groupChatId = GroupChat::where('ticket_id', $request->ticket_id)->value('id');
            $groupChatUser = new GroupChatUser();
            $groupChatUser->group_chat_id = $groupChatId;
            $groupChatUser->gena_health_user_id = $request->ticket_assigned_to;
            $groupChatUser->gena_health_user_guard = 'web_users';
            $groupChatUser->save();

            return redirect()->route('ticket_list')->with(['success' => 'Ticket  has been updated successfully!']);

        }

        if ($ticket->ticket_assigned_to == $request->ticket_assigned_to) {
            $ticket->status_id = $request->status;
            $ticket->priority = $request->priority;
            $ticket->update();
            return redirect()->route('ticket_list')->with(['success' => 'Ticket  has been updated successfully!']);
        }

        if ($ticket->ticket_assigned_to != null && $ticket->ticket_assigned_to != $request->ticket_assigned_to) {
            $ticket->status_id = $request->status;
            $ticket->priority = $request->priority;
            $ticket->ticket_assigned_to = $request->ticket_assigned_to;
            $ticket->ticket_assigned_to_guard = 'web_users';
            $ticket->update();

            //Update or Insert Records in TicketAssignedToWebUser table......
            TicketAssignedToWebUser::where(['ticket_id' => $request->ticket_id, 'ticket_revoke_date' => null, 'is_blocked' => 0])->update([
                'ticket_revoke_date' => now(),
                'is_blocked' => 1,
            ]);

            $TicketAssignedToWebUser = new TicketAssignedToWebUser();
            $TicketAssignedToWebUser->ticket_id = $request->ticket_id;
            $TicketAssignedToWebUser->gena_health_user_id = $request->ticket_assigned_to;
            $TicketAssignedToWebUser->gena_health_user_guard = 'web_users';
            $TicketAssignedToWebUser->ticket_assigned_date = now();
            $TicketAssignedToWebUser->save();

            //Insert Records in GroupChat table......
            $groupChatId = GroupChat::where(['ticket_id' => $request->ticket_id])->value('id');
            //dd($previous_ticket_assign);
             GroupChatUser::where(['group_chat_id' => $groupChatId, 'gena_health_user_id' =>$previous_ticket_assign, 'gena_health_user_guard' => 'web_users', 'is_blocked' => 0])->update([
                'is_blocked' => 1,
            ]);




            $groupChatUser = new GroupChatUser();
            $groupChatUser->group_chat_id = $groupChatId;
            $groupChatUser->gena_health_user_id = $request->ticket_assigned_to;
            $groupChatUser->gena_health_user_guard = 'web_users';
            $groupChatUser->save();

            return redirect()->route('ticket_list')->with(['success' => 'Ticket  has been updated successfully!']);

        }

    }

   

    public function assignTickets(Request $request)
    {

        // Updaing Ticket Table...
        $getTicket = Ticket::where('id', $request->id)->first();
        $getTicket->ticket_assigned_to = $request->nutritionist_id;
        $getTicket->ticket_assigned_to_guard = 'web_users';
        $getTicket->update();

        //Insert Records in TicketAssignedToWebUser table......
        $TicketAssignedToWebUser = new TicketAssignedToWebUser();
        $TicketAssignedToWebUser->ticket_id = $request->id;
        $TicketAssignedToWebUser->gena_health_user_id = $request->nutritionist_id;
        $TicketAssignedToWebUser->gena_health_user_guard = 'web_users';
        $TicketAssignedToWebUser->ticket_assigned_date = now();
        $TicketAssignedToWebUser->save();

        //Insert Records in GroupChat table......
        $groupChatId = GroupChat::where('ticket_id', $request->id)->value('id');
        $groupChatUser = new GroupChatUser();
        $groupChatUser->group_chat_id = $groupChatId;
        $groupChatUser->gena_health_user_id = $request->nutritionist_id;
        $groupChatUser->gena_health_user_guard = 'web_users';
        $groupChatUser->save();
        return response()->json([
            'success' => 1,
        ]);
    }


    public function view($id)
    {
        $ticketDetails = Ticket::with('user')->orderByDesc('id')->where('id', $id)->first();

         $ticketInfo = Ticket::getTicketsMessage(request()->id);
        $activeNutiritionist = Nutritionist::ACTIVE_NUTRITIONIST();

        if($ticketDetails->ticket_type==Ticket::TypeDietPlan){
          return view('ticket.diet_plan_view', ['data' => $ticketDetails, 'nutiritionists' => $activeNutiritionist,'ticketInfo'=>$ticketInfo]);
        }

       
        
        return view('ticket.view', ['ticket' => $ticketDetails, 'nutiritionists' => $activeNutiritionist,'ticketInfo'=>$ticketInfo]);

    }

}
