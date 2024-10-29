<?php

namespace App\Listeners;

use App\InsiderUserLoginHistory;
use GeoIP;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
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
        $attempt = new InsiderUserLoginHistory();
        if (isset($event->user->id)) {
            $attempt->insider_user_id = $event->user->id;
        }
        $attempt->ip = GeoIP::getLocation()->ip;
        $attempt->action = 'logout';
        $attempt->save();
    }
}
