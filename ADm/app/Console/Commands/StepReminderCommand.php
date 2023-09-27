<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendStepReminderPushNotificationJob;

class StepReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:step';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will remind the user for step tracking';

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
        $stepReminderData = \DB::table('step_reminders')
            ->select('users.device_token', 'users.id AS user_id', 'step_reminders.cron_time')
            ->join('users', 'users.id', '=', 'step_reminders.user_id')
            ->where('step_reminders.cron_time', '<', now())
            ->get()
            ->toArray();

        foreach ($stepReminderData as $stepReminder) {

            $fcmTokens[] = $stepReminder->device_token;

            $notificationDat[] = [
                'notification_template_id' => 5,
                'notification_to' => $stepReminder->user_id,
                'notification_to_guard' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }


        if (!empty($stepReminderData)) {

            \App\Models\Notification::insert($notificationDat); //Save notification to table for showing notification in notification tab
            dispatch(new SendStepReminderPushNotificationJob($stepReminderData, $fcmTokens)); // Send push notification to user
        }
    }
}
