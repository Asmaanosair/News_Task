<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use jcobhams\NewsApi\NewsApi;
use Throwable;

class NewsApiService implements NewsInterface
{
    public function fetchArticles(): array
    {
        $api_key = config('services.news_api.key');
        $newsApi = new NewsApi($api_key);
        try {
            $response = $newsApi->getTopHeadlines(
                country: config('services.news_api.country'),
                page_size: config('services.news_api.page_size'),
                page: config('services.news_api.page')
            );
            if ($response->status !== 'ok' || empty($response->articles)) {
                Log::warning('NewsAPI: No top headlines found');

                return [];
            }

            return $response->articles;
        } catch (Throwable $e) {
            Log::error('NewsAPI fetch failed ');
            report($e);
            return [];
        }
    }
}
