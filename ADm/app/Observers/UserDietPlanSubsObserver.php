<?php

namespace App\Observers;

use App\Models\UserDietPlanSubscription;
use Illuminate\Support\Str;
use App\Models\Ticket;

class UserDietPlanSubsObserver
{
    /**
     * Handle the UserDietPlanSubscription "created" event.
     *
     * @param  \App\Models\UserDietPlanSubscription  $userDietPlanSubscription
     * @return void
     */
    public function created(UserDietPlanSubscription $userDietPlanSubscription)
    {
        /**
         * Create ticket when user buy a new diet plan but if user have upgrade the
         * same plan then no need to create new ticket
         * */
        if ($userDietPlanSubscription->diet_plan_subscription_id != 1) {

            if (!UserDietPlanSubscription::where(['user_id' => auth()->id(), 'diet_plan_subscription_id' => $userDietPlanSubscription->diet_plan_subscription_id])->where('id', '!=', $userDietPlanSubscription->id)->status()->exists())  {

                $ticket = Ticket::where(['ticket_owner_id' => auth()->id(), 'ticket_owner_guard' => config('common.guards.users')])->whereNotNull('ticket_assigned_to')->first();

                if ($ticket == null) {

                    $newTicket = new Ticket;

                    $newTicket->ticket_owner_guard = config('common.guards.users');
                    $newTicket->ticket_owner_id = auth()->id();
                    $newTicket->priority = 'high';
                    $newTicket->status_id = 10;


                } else {

                    $newTicket = $ticket->replicate();
                    $newTicket->ticket_type = config('common.models.tickets.ticket_type.diet_plan');
                    $newTicket->unique_ticket_id = Str::random(7);
                }

                $newTicket->category = config('common.models.tickets.category.3');
                $newTicket->save();
            }
        }
    }

    /**
     * Handle the UserDietPlanSubscription "updated" event.
     *
     * @param  \App\Models\UserDietPlanSubscription  $userDietPlanSubscription
     * @return void
     */
    public function updated(UserDietPlanSubscription $userDietPlanSubscription)
    {
        //
    }

    /**
     * Handle the UserDietPlanSubscription "deleted" event.
     *
     * @param  \App\Models\UserDietPlanSubscription  $userDietPlanSubscription
     * @return void
     */
    public function deleted(UserDietPlanSubscription $userDietPlanSubscription)
    {
        //
    }

    /**
     * Handle the UserDietPlanSubscription "restored" event.
     *
     * @param  \App\Models\UserDietPlanSubscription  $userDietPlanSubscription
     * @return void
     */
    public function restored(UserDietPlanSubscription $userDietPlanSubscription)
    {
        //
    }

    /**
     * Handle the UserDietPlanSubscription "force deleted" event.
     *
     * @param  \App\Models\UserDietPlanSubscription  $userDietPlanSubscription
     * @return void
     */
    public function forceDeleted(UserDietPlanSubscription $userDietPlanSubscription)
    {
        //
    }
}
