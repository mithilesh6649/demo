<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendMedicineReminderPushNotificationJob;

class MedicineReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:medicine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send the push notification to the users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $medicineReminderData = \App\Models\MedicineTracker::select('medicine_trackers.id AS medicine_tracker_id', 'medicine_reminders.id AS medicine_reminder_id', 'users.device_token', 'users.id AS user_id', 'medicine_trackers.medicine_name', 'medicine_reminders.remind_time')
        ->where('medicine_trackers.start_date', '<', now())
        ->where('medicine_trackers.end_date', '>', now())
        ->where('medicine_trackers.status', 1)
        ->join('users', 'users.id', '=', 'medicine_trackers.user_id')
        ->join('medicine_schedulers', 'medicine_schedulers.medicine_tracker_id', '=', 'medicine_trackers.id')
        ->join('medicine_reminders' ,'medicine_reminders.medicine_tracker_id', '=', 'medicine_trackers.id')
        ->where(['medicine_schedulers.week_days' => now()->weekday(), 'medicine_reminders.cron_run' => 0])
        ->whereTime('medicine_reminders.remind_time', '<', now()->format('H:i:s'))
        ->orderBy('medicine_reminders.remind_time', 'DESC')
        ->distinct('medicine_trackers.id')
        ->get();

        if (!$medicineReminderData->isEmpty()) {

            foreach ($medicineReminderData as $key => $reminder) {

                $deviceToken[] = $reminder->device_token;
                $medicineReminderIds[] = $reminder->medicine_reminder_id;
                $notificationData[$key]['user_id'] = $reminder->user_id;
                $notificationData[$key]['medicine_reminder_id'] = $reminder->medicine_reminder_id;
                $notificationData[$key]['medicine_name'] = $reminder->medicine_name;
            }

            //TODO: Send push notification to users
            dispatch ( new SendMedicineReminderPushNotificationJob($notificationData, $deviceToken) );

            //Update reminder cron_run column
            \App\Models\MedicineReminder::whereIn('id', $medicineReminderIds)->update(['cron_run' => 1]);
        }
    }
}
