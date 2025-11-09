<?php

namespace App\Jobs;

use App\Services\SourceFactory;
use App\Services\SourceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchArticlesJob implements ShouldQueue
{
    use Queueable;

    public string $source;

    /**
     * Create a new job instance.
     */
    public function __construct($source)
    {
        $this->source = $source;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $provider = SourceFactory::fromService($this->source);
        $service = new SourceService($provider);
        $service->insertArticles();
    }
}
