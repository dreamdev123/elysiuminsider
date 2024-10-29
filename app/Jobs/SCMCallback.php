<?php

namespace App\Jobs;

use App\Services\SCMCallbackService\SCMCallbackService;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SCMCallback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // php artisan queue:work --queue=scm-callback --sleep=1 --tries=1
        // php artisan queue:retry all

        $decodedData = json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR);

        SCMCallbackService::dispatchMessage($decodedData[0]);
    }
}
