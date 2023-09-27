<?php

namespace App\Services;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;

class NotificationService{

    /**
     * Function: listNotification
     * Functionality: This function will List the
     * notification of the user
     *
     *@return array
     */
    public function listNotification()
    {
        try {

            $paginateOffset = (request()->has('page')) ? (request()->page * 20) - 20 : 0;
            $notificationList = auth()->user()->notifications()->with('notificationTemplate')->offset($paginateOffset)->limit(20)->get();

            return ['status' => 200, 'success' => true, 'data' => NotificationResource::collection($notificationList), 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: deleteNotification
     * Functionality: This function will delete the notification of the user permanantly
     *
     *@return array
     */
    public function deleteNotification()
    {
        try {

            auth()->user()->notifications()->where('id', request()->id)->delete();

            return ['status' => 200, 'success' => true, 'message' => 'Notifcation deleted successfully', 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: changeNotificationReadStatus
     * Functionality: This function will change the status of
     * notification to read
     *
     * @return array
     */
    public function changeNotificationReadStatus()
    {
        try {

            auth()->user()->notifications()->where('id', request()->id)->update(['read' => 1]);

            return ['status' => 200, 'success' => true, 'message' => 'Notifcation updated successfully', 'error' => false];

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }
}
