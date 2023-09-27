<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendRegisterOTPToPhoneJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $twilioSendMessageBaseURL;

    protected $postData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($twilioSendMessageBaseURL, $postData)
    {
        $this->twilioSendMessageBaseURL = $twilioSendMessageBaseURL;
        $this->postData = $postData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('heo');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->twilioSendMessageBaseURL,
            CURLOPT_USERPWD => config('common.twilio.sid') . ":" . config('common.twilio.token'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $this->postData,
        ));

        $response = curl_exec($curl);

        \Log::info(['I am from OTP to mobile here is the response' => $response]);


        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            \Log::info(['I am from OTP to mobile' => $error_msg]);


        }
        curl_close($curl);
    }
}
