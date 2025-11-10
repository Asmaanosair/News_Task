<?php

namespace App\Jobs;

use App\Enums\SourceEnums;
use App\Services\SourceService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Throwable;

class FetchArticlesJob implements ShouldQueue
{
    use Queueable;

    public SourceEnums $source;

    /**
     * Create a new job instance.
     */
    public function __construct(SourceEnums $source)
    {
        $this->source = $source;
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(SourceService $service): void
    {
        try {
            $service->insertArticles($this->source);
        } catch (Throwable $e) {
            Log::error('Failed to insert articles source: ' . $this->source->value);
            report($e);
        }
    }
}
