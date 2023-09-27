<?php

namespace App\Observers;

use App\Models\AppointmentMetadata;

class AppointmentMetadataObserver
{
    /**
     * Handle the AppointmentMetadata "created" event.
     *
     * @param  \App\Models\AppointmentMetadata  $appointmentMetadata
     * @return void
     */
    public function created(AppointmentMetadata $appointmentMetadata)
    {
        $this->notifyInvitee($appointmentMetadata, true);
    }

    /**
     * Handle the AppointmentMetadata "updated" event.
     *
     * @param  \App\Models\AppointmentMetadata  $appointmentMetadata
     * @return void
     */
    public function updated(AppointmentMetadata $appointmentMetadata)
    {
        $this->notifyInvitee($appointmentMetadata);
    }

    /**
     * Handle the AppointmentMetadata "deleted" event.
     *
     * @param  \App\Models\AppointmentMetadata  $appointmentMetadata
     * @return void
     */
    public function deleted(AppointmentMetadata $appointmentMetadata)
    {
        //
    }

    /**
     * Handle the AppointmentMetadata "restored" event.
     *
     * @param  \App\Models\AppointmentMetadata  $appointmentMetadata
     * @return void
     */
    public function restored(AppointmentMetadata $appointmentMetadata)
    {
        //
    }

    /**
     * Handle the AppointmentMetadata "force deleted" event.
     *
     * @param  \App\Models\AppointmentMetadata  $appointmentMetadata
     * @return void
     */
    public function forceDeleted(AppointmentMetadata $appointmentMetadata)
    {
        //
    }

    private function notifyInvitee($appointmentData, $newAppointmentRequested = false)
    {
        $appointmentData = $appointmentData->with(['appointment.inviteeUser', 'appointment.appUser'])->first();

        if ($appointmentData->appointment->inviteeUser->email) {

            $userName = $appointmentData->appointment->appUser->name;
            $appointmentDate = $appointmentData->appointment_time;

            $message = ($newAppointmentRequested) ? "You have new Appointment request from $userName on $appointmentDate" : "Your Appointment with $userName is updated and will be scheduled on $appointmentDate";

            $data = [
                'invitee_email' => $appointmentData->appointment->inviteeUser->email,
                'invitee_name' => $appointmentData->appointment->inviteeUser->name,
                'message' => $message,
            ];

            dispatch(new \App\Jobs\SendAppointmentRequestJob($data));
        }
    }
}
