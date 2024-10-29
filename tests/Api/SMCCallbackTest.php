<?php

namespace Tests\Api;

use Tests\TestCase;

class SMCCallbackTest extends TestCase
{
    public function testAPISCMCallbackFailAuth(): void
    {
        // set token for future tests
        $this->setHeaderToken();

        $response = $this->json(
            'POST',
            route('api::callback'),
            [
                'payload' => '["testFeature"]'
            ],
            [
                config('api.scm.key') => config('api.scm.value')  . 'FAIL'
            ]
        );

//        print_r(json_decode($response->getContent(), true));die;

        $response
            ->assertStatus(401)
            ->assertJson([
                'error' => 'Unauthorized'
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAPISCMCallback(): void
    {
        // set token for future tests
        $this->setHeaderToken();

        $response = $this->json(
            'POST',
            route('api::callback'),
            [
                'payload' => '["testFeature"]'
            ],
            self::$headerTokenSMCCALLBACK
        );

//        print_r(json_decode($response->getContent(), true));die;

        $response
            ->assertStatus(200)
            ->assertJson([
                'success'
            ]);
    }

    public function testAPISCMCallbackFailPayloadField(): void
    {
        // set token for future tests
        $this->setHeaderToken();

        $response = $this->json(
            'POST',
            route('api::callback'),
            [
                'payloadFAIL' => '["testFeature"]'
            ],
            [
                config('api.scm.key') => config('api.scm.value')
            ]
        );

//        print_r(json_decode($response->getContent(), true));die;

        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => [
                    'payload' => [
                        0 => 'The payload field is required.'
                    ]
                ]
            ]);
    }

    public function testAPISCMCallbackFailPayloadFieldValue(): void
    {
        // set token for future tests
        $this->setHeaderToken();

        $response = $this->json(
            'POST',
            route('api::callback'),
            [
                'payload' => '["testFeature'
            ],
            [
                config('api.scm.key') => config('api.scm.value')
            ]
        );

//        print_r(json_decode($response->getContent(), true));die;

        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => [
                    'payload' => [
                        0 => 'The payload must be a valid JSON string.'
                    ]
                ]
            ]);
    }
}
