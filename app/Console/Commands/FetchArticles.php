<?php

namespace App\Console\Commands;

use App\Enums\SourceEnums;
use App\Jobs\FetchArticlesJob;
use App\Services\SourceFactory;
use App\Services\SourceService;
use Illuminate\Console\Command;

class FetchArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch articles from API';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (SourceEnums::SOURCE_TYPE as $sourceName) {
           FetchArticlesJob::dispatch($sourceName);
        }
    }
}
