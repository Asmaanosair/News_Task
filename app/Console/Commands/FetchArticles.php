<?php

namespace App\Console\Commands;

use App\Enums\SourceEnums;
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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (SourceEnums::cases() as $sourceName) {
            $provider = SourceFactory::fromService($sourceName);
            $service = new SourceService($provider);
            $service->insertArticles();
        }
    }
}
