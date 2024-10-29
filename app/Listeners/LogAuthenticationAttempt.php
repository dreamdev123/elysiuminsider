<?php

namespace App\Listeners;

use App\InsiderUser;
use App\InsiderUserLoginHistory;
use GeoIP;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogAuthenticationAttempt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event): void
    {
        $user = InsiderUser::where(['username' => $event->credentials['username']])->first();

        if ($user) {
            $attempt = new InsiderUserLoginHistory();
            $attempt->insider_user_id = $user->id;
            $attempt->ip = GeoIP::getLocation()->ip;
            $attempt->save();

        } else {
            $attempt = new InsiderUserLoginHistory();
            $attempt->email = $event->credentials['username'];
            $attempt->ip = GeoIP::getLocation()->ip;
            $attempt->save();
        }
    }
}
