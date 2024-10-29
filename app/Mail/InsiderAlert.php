<?php

namespace App\Mail;

use App\InsiderUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InsiderAlert extends Mailable
{
//    use Queueable, SerializesModels;
    use SerializesModels;

    private $user;

    /**
     * PasswordReset constructor.
     * @param InsiderUser $user
     */
    public function __construct(InsiderUser $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('ENTRY MARKET RISK LEVELS')
            ->view('_mail.insider-alert');
    }
}
