<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
//    use Queueable, SerializesModels;
    use SerializesModels;

    private $userData;

    /**
     * ContactUs constructor.
     * @param $userData
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Elysium Insider - customer contact')
            ->view('_mail.contact-us')
            ->with('userData', $this->userData);
    }
}
