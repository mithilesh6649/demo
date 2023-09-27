<?php

namespace App\Services;

use App\Services\NotificationService;

class PushNotificationService
{
    /**
     * @var array $tokens
     */
    protected $tokens;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $image
     */
    protected $image;

    /**
     * @var string $body
     */
    protected $body;

    /**
     * @var array $tokens
     */
    protected $additionalData;

    public function __construct($messageData, $tokens)
    {
        $this->title = $messageData['title'];
        $this->body = $messageData['body'];
        $this->image = $messageData['image'];
        $this->tokens = $tokens;
        $this->additionalData = $messageData['data'];

        $this->notify();
    }

    private function notify()
    {
        $data = [
            "registration_ids" => $this->tokens,
            "notification" => [
                   "title" => $this->title,
                   "body" => $this->body,
                   'image' => $this->image
            ],
            'data' => $this->additionalData,
            'content_available' => true,
            'priority' => 'high',
        ];

        $headers = [
        'Authorization: key='.config('common.firebase.push_notification.server_key'),
        'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('common.firebase.push_notification.endpoint_url'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {

            $error_msg = curl_error($ch);
            \Log::channel('pushnotification')->info('***********************Exception from Push Notification**********************************', [$error_msg]);
        }

        curl_close($ch);
    }
}
