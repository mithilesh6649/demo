<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\PushNotificationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\WaterReminder;

class SendWaterReminderPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $waterReminder = $this->data;

        foreach ($waterReminder as $reminder) {

            if ($reminder->repetition_count != 0) {

                $tokens[] = $reminder->device_token;

            }

            $repetitionCount = (now() >= now()->parse($reminder->end_time)) ? $reminder->actual_repetition_count : $reminder->repetition_count - 1;

            switch($reminder->reminder_type) {

                case 'once':
                    $dataForUpdate = [
                        'user_id' => $reminder->user_id,
                        'cron_time' => $reminder->add_time_to_cron_time,
                        'add_time_to_cron_time' => now()->parse($reminder->add_time_to_cron_time)->addDay(),
                    ];
                    break;

                default:

                    $secondCronTime = now()->parse($reminder->add_time_to_cron_time);
                    $firstCronTime = now()->parse($reminder->cron_time);
                    $differenceInMins = $secondCronTime->diffInMinutes($firstCronTime);

                    $dataForUpdate = [
                        'user_id' => $reminder->user_id,
                        'cron_time' => $reminder->add_time_to_cron_time,
                        'add_time_to_cron_time' => now()->parse($secondCronTime)->addMinutes($differenceInMins),
                        'repetition_count' => $repetitionCount,
                    ];
                    break;
            }

            $notificationDat[] = [
                'notification_template_id' => 1,
                'notification_to' => $reminder->user_id,
                'notification_to_guard' => 'users',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            \App\Models\WaterReminder::where('id', $reminder->water_reminder_id)->update($dataForUpdate);

        }

        $notificationTemplate = \App\Models\NotificationTemplate::find(1);

        $notificationData = [
            'title' => $notificationTemplate->title,
            'body' => $notificationTemplate->body,
            'image' => $notificationTemplate->notification_image,
            'data' => [
                'notification_type' => 'water_tracker'
            ]
        ];

        if (!empty($notificationDat)) {

            \App\Models\Notification::insert($notificationDat);
            new PushNotificationService($notificationData, $tokens);
        }
    }
}
