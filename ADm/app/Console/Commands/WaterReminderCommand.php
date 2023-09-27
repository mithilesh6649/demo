<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendWaterReminderPushNotificationJob;

class WaterReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:water';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send the water reminder to the user.';

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
        $waterReminderData = \DB::table('water_reminders')->select('users.device_token', 'users.id AS user_id', 'water_reminders.id AS water_reminder_id', 'water_reminders.cron_time', 'water_reminders.repetition_count', 'water_reminders.reminder_type', 'water_reminders.actual_repetition_count', 'water_reminders.user_id', 'water_reminders.end_time', 'water_reminders.add_time_to_cron_time', 'interval_time')->join('users', 'users.id', '=', 'water_reminders.user_id')->where('water_reminders.status', 1)->where('water_reminders.cron_time', '<', now())->where('water_reminders.end_time', '>', now())->get()->toArray();

        if (!empty($waterReminderData)) {

            dispatch(new SendWaterReminderPushNotificationJob($waterReminderData));
        }
        //TODO: Dispatch it in Queue and then send notifications
    }
}
