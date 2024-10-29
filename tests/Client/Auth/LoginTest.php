<?php

namespace Tests\Feature\Auth;

use Exception;
use Tests\TestCase;

/**
 * Class LoginTest
 * @package Tests\Feature\Auth
 */
class LoginTest extends TestCase
{
    public function testLoginPage(): void
    {
        $response = $this->get(
            route('auth::login')
        );
//        print_r($response->getContent());die;
        $response
            ->assertStatus(200)
            ->assertSee('input type="email" name="email"');
    }

    public function testLoginFailed(): void
    {
        $response = $this->post(
            route('auth::login')
        );

//        print_r($response->getContent());die;
        $response
            ->assertStatus(302);
    }

    /**
     * @throws Exception
     */
    public function testLoginSuccess(): void
    {
        $this->followingRedirects();

        $response = $this->post(
            route('auth::login'),
            [
                'email' => self::getEmail(),
                'password' => self::getPassword()
            ]
        );

//        print_r($response->getContent());die;
        $response
            ->assertStatus(200)
            ->assertViewIs('panel.user.personal_information');
    }

    /**
     * @throws Exception
     */
    public function testLogout(): void
    {
        $this->followingRedirects();

        $response = $this->actingAs(self::getUser())->get(
            route('auth::logout')
        );

//        print_r($response->getContent());die;
        $response
            ->assertStatus(200)
            ->assertSee('Successfully logged out from panel !');
    }
}
