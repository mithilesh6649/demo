<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\UserTest;
use App\Models\Ticket;


class UserTestObserver
{
    /**
     * Handle the UserTest "created" event.
     *
     * @param  \App\Models\UserTest  $userTest
     * @return void
     */
    public function created(UserTest $userTest)
    {
        // FIXME: This is for developement purpose
        \DB::table('user_reports')->insert([
            'document_url' => 'https://server3.rvtechnologies.in/Gena-HealthX/api/storage/app/public/Reports/rep-4-1676900731.pdf',
            'report_no' => Str::random(20),
            'user_test_id' => $userTest->id,
            'user_id' => auth()->id(),
            'test_id' => $userTest->test_id,
            'uploaded_by' => 1,
            'uploaded_by_guard' => 'clinicians',
            'document_type' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!Ticket::where(['ticket_owner_id' => $userTest->user_id, 'ticket_owner_guard' => config('common.guards.users'), 'ticket_type' => config('common.models.tickets.ticket_type.test')])->exists()) {

            $testTicket = new Ticket;

            $testTicket->payment_transation_id = $userTest->payment_transaction_id;
            $testTicket->ticket_type = config('common.models.tickets.ticket_type.test');
            $testTicket->category = config('common.models.tickets.category.5');
            $testTicket->ticket_owner_guard = config('common.guards.users');
            $testTicket->ticket_owner_id = $userTest->user_id;
            $testTicket->priority = 'high';
            $testTicket->status_id = 10;

            $testTicket->save();
        }
    }

    /**
     * Handle the UserTest "updated" event.
     *
     * @param  \App\Models\UserTest  $userTest
     * @return void
     */
    public function updated(UserTest $userTest)
    {
        //
    }

    /**
     * Handle the UserTest "deleted" event.
     *
     * @param  \App\Models\UserTest  $userTest
     * @return void
     */
    public function deleted(UserTest $userTest)
    {
        //
    }

    /**
     * Handle the UserTest "restored" event.
     *
     * @param  \App\Models\UserTest  $userTest
     * @return void
     */
    public function restored(UserTest $userTest)
    {
        //
    }

    /**
     * Handle the UserTest "force deleted" event.
     *
     * @param  \App\Models\UserTest  $userTest
     * @return void
     */
    public function forceDeleted(UserTest $userTest)
    {
        //
    }
}
