<?php

namespace App\Mail;

use App\InsiderUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable
{
//    use Queueable, SerializesModels;
    use SerializesModels;

    private $user;
    private $resetLink;

    /**
     * PasswordReset constructor.
     * @param InsiderUser $user
     * @param string $resetLink
     */
    public function __construct(InsiderUser $user, string $resetLink)
    {
        $this->user = $user;
        $this->resetLink = $resetLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Elysium Insider - Password Reset')
            ->view('_mail.password-reset')
            ->with([
                'user' => $this->user,
                'resetLink' => $this->resetLink
            ]);
    }
}
