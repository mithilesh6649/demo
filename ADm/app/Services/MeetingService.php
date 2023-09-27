<?php

namespace App\Services;

use App\Models\Appointment;

class MeetingService {

    protected $errorResponse = ['status' => 400, 'success' => false, 'message' => 'Something went wrong', 'error' => true];
    /**
     * Function bookAppointment
     * Functionality: the request will initiate from  the user side
     * admin/nutritionist can approve it.
     *
     * @param object $data
     *
     * @return array
     */
    public function bookAppointment($data)
    {
        if ($data->has('booking_date') && $data->has('consultant_id')) {

            try {

                $timeSlot = explode('-', $data->time_slot);
                $appointment = Appointment::firstOrCreate(['user_id' => auth()->id(), 'invitee_id' => $data->consultant_id]);

                $chechAlreadyScheduled = new Appointment;

                if ($chechAlreadyScheduled->alreadyScheduled($data->consultant_id, $data->booking_date, $timeSlot)) {

                    return ['status' => 400, 'success' => true, 'message' => 'Appointment Already Scheduled', 'error' => true];
                }

                $appointment->requestedAppointment()->updateOrCreate(['appointment_id' => $appointment->id], ['appointment_time' => $data->booking_date, 'start_time' => $timeSlot[0] , 'end_time' => $timeSlot[1], 'status' => 1]);

                return ['status' => 200, 'success' => true, 'message' => 'Appointment booked successfully', 'error' => false];

            } catch (\Exception $e) {

                return $this->errorResponse;
            }
        }
        return $this->errorResponse;
    }
}
