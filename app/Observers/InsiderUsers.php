<?php

namespace App\Observers;

use App\InsiderUser;
use App\InsiderUserPasswordChangesHistory;
use GeoIP;

class InsiderUsers
{
    public function updating(InsiderUser $user): void
    {
        // check if password changed
        $this->savePasswordChange($user);
    }

    /**
     * @param InsiderUser $user
     * @return InsiderUser
     */
    private function savePasswordChange(InsiderUser $user): InsiderUser
    {
        if ($user->isDirty('password')) {
            $passwordChangesHistory = new InsiderUserPasswordChangesHistory();
            $passwordChangesHistory->insider_user_id = $user->id;
            $passwordChangesHistory->ip = GeoIP::getLocation()->ip;
            $passwordChangesHistory->save();
        }

        return $user;
    }
}
