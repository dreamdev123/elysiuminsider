<?php

namespace Tests\Feature\Panel\User;

use Exception;
use Tests\TestCase;

/**
 * Class LoginTest
 * @package Tests\Feature\Auth
 */
class InformationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testPersonalInformationPage(): void
    {
        $this->followingRedirects();

        $response = $this->actingAs(self::getUser())->get(
            route('personal_information')
        );

//        print_r($response->getContent());die;
        $response
            ->assertStatus(200)
            ->assertSee('<h3 class="mb-2">Personal information</h3>');
    }
}
