<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDietPlanExpiredNotificationToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userIds;

    protected $fcmTokens;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userIds, $fcmTokens)
    {
        $this->userIds = $userIds;
        $this->fcmTokens = $fcmTokens;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notificationTemplate = \App\Models\NotificationTemplate::where('slug', config('common.models.notification_templates.slug.plan_expired'))->first();

        for ($i = 0; $i < count($userIds); $i++) {

            $notificationData [] =  [
                'notification_to' => $userIds[$i],
                'notification_template_id' => $notificationTemplate->id,
                'notification_to_guard' => config('common.guards.users'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        \DB::table('notifications')->insert($notificationData);

        $pushNotificationData = [
            'title' => $notificationTemplate->title,
            'body' => $notificationTemplate->body,
            'image' => $notificationTemplate->notification_image,
            'data' => [
                'notification_type' => config('common.models.notification_templates.slug.plan_expired')
            ]
        ];

        new PushNotificationService($notificationData, $this->fcmTokens);
    }
}
