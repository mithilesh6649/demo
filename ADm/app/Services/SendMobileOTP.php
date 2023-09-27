<?php

namespace App\Services;

use App\Models\MdDropdown;
use Illuminate\Support\Str;
use App\Jobs\SendRegisterOTPToPhoneJob;
use App\Models\User;
use App\Models\Verification;
use DB;

class SendMobileOTP {


    /**
     * Fnc sendOTPToPhoneNumber will send the OTP to given Phone number
     *
     * @param array $otpData
     * @param string $message
     *
     * @return boolean
     */
    public function sendOTPToPhoneNumber( array $otpData, $messageBody = null)
    {
        try {
            if (is_null($messageBody)) {

                $messageBody = SendMobileOTP::getMessageBody($otpData['otp_message_slug']);
                $messageBody = Str::replaceArray('?', [$otpData['otp']], $messageBody);
            }

            $twilioSendMessageBaseURL = config('common.twilio.base_url');
            $twilioSendMessageBaseURL .= config('common.twilio.sid');
            $twilioSendMessageBaseURL .= '/Messages.json';

            $postData = [
                'To' => $otpData['phone_number'],
                'From' => config('common.twilio.from'),
                'Body' => $messageBody
            ];

            \Log::info(['requesting to twilio for sms' => $postData]);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $twilioSendMessageBaseURL,
                CURLOPT_USERPWD => config('common.twilio.sid') . ":" . config('common.twilio.token'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postData,
            ));

            $response = curl_exec($curl);

            curl_close($curl) ;
            \Log::info(['response from twilio sms' => $response]);
            return true;
            // dispatch(new SendRegisterOTPToPhoneJob($twilioSendMessageBaseURL, $postData));

        } catch (\Exception $e) {

            return false;
        }
    }

    public function getMessageBody($messageType)
    {
        return MdDropdown::where('slug', $messageType)->value('value');
    }
}
