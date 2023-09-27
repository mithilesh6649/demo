<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendWeightReminderPushNotificationJob;

class WeightReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:weight';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send the push notification to the user for reminding for measuring weight.';

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
        $weightReminderData = \DB::table('weight_reminders')
        ->select('users.device_token', 'users.id AS user_id')
        ->join('users', 'users.id', '=', 'weight_reminders.user_id')
        ->where('weight_reminders.cron_time', '<', now())
        ->where('weight_reminders.status', 1)
        ->get()
        ->toArray();

        foreach ($weightReminderData as $weightReminder) {

            $fcmTokens[] = $weightReminder->device_token;

            $notificationDat[] = [
                'notification_template_id' => 4,
                'notification_to' => $weightReminder->user_id,
                'notification_to_guard' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        \App\Models\Notification::insert($notificationDat);

        dispatch(new SendWeightReminderPushNotificationJob($weightReminderData, $fcmTokens));
    }
}
