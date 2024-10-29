<?php

namespace App\Mail;

use App\InsiderUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
//    use Queueable, SerializesModels;
    use SerializesModels;

    private $user;
    private $verificationLink;

    /**
     * EmailVerification constructor.
     * @param InsiderUser $user
     * @param string $verificationLink
     */
    public function __construct(InsiderUser $user, string $verificationLink)
    {
        $this->user = $user;
        $this->verificationLink = $verificationLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Elysium Insider - Email Verification')
            ->view('_mail.email-verification')
            ->with([
                'user' => $this->user,
                'verificationLink' => $this->verificationLink
            ]);
    }
}
