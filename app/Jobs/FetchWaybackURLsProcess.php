<?php

namespace App\Jobs;

use App\Domain\Models\UrlCollection;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchWaybackURLsProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(URLCollection $URls)
    {  
        $URls->each(function () {
            $this->fetchWayBackURL($url);
        });
    }

    public function fetchWayBackURL (string $url) {
        $wayBackURL = sprintf('http://archive.org/wayback/available?url=%s', $url);
        $response = $this->client->request('GET', $wayBackURL);

        dd($response);
    }
}
