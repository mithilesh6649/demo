<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailVerificationLink extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;

    protected $randomNumber;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $randomNumber)
    {
        $this->details = $details;
        $this->randomNumber = $randomNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        \Log::info(['I am inside SendEmailVerificationLink File ' => $this->details, $this->randomNumber]);
        return $this->view('emails.SendEmailVerificationLink', ['mail_data' => $this->details, 'otp' => $this->randomNumber]);
    }
}
