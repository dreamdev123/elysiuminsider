<?php

namespace Tests\Feature\Auth;

use Exception;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRegisterPage(): void
    {
        $response = $this->get(
            route('auth::register')
        );
//        print_r($response->getContent());die;
        $response
            ->assertStatus(200)
            ->assertSee('form data-form="register"');
    }

    /**
     * @throws Exception
     */
    public function testRegisterSuccess(): void
    {
        $this->followingRedirects();
echo self::getEmail() . PHP_EOL;
        $response = $this->post(
            route('auth::register'),
            [
                'affiliate' => 'Adam6',
                'first_name' => 'Gulios First',
                'last_name' => 'Gulios last',
                'email' => self::getEmail(),
                'email_confirmation' => self::getEmail(),
                'password' => self::getPassword(),
                'password_confirmation' => self::getPassword(),
            ]
        );

//        print_r($response->getContent());die;
        $response
            ->assertStatus(200)
            ->assertViewIs('panel.user.personal_information');
    }
}
