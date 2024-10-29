<?php

namespace Tests;

use App\InsiderUser;
use Auth;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, MigrateFreshSeedOnce;

    public static $headerTokenSMCCALLBACK = [];

    private static $email = '';
    private static $password = '';

    public function setHeaderToken(): void
    {
        self::$headerTokenSMCCALLBACK = [
            config('api.scm.key') => config('api.scm.value')
        ];
    }

    /**
     * @return InsiderUser|null
     * @throws Exception
     */
    public static function getUser(): ?InsiderUser
    {
        Auth::attempt(['email' => self::getEmail(), 'password' => self::getPassword(), 'status' => 'enabled']);

        return Auth::user();
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function getEmail(): string
    {
        if (empty(self::$email)) {
            return self::$email = 'gulios+' . random_int(1, 10000) . '@gulios.pl';
        }

        return self::$email;
    }

    /**
     * @return string
     */
    public static function getPassword(): string
    {
        return self::$password = 'zaq123ZAQ!@#';
    }
}
