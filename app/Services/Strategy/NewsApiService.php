<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;
use App\Services\Adaptor\NewsApi as AdaptorNewsApi;
use Exception;
use Illuminate\Support\Facades\Log;
use jcobhams\NewsApi\NewsApi;

class NewsApiService implements NewsInterface
{
    /**
     * @var AdaptorNewsApi
     */
    protected AdaptorNewsApi $newsApi;

    public function __construct()
    {
        $this->newsApi = new AdaptorNewsApi();
    }

    public function fetchArticles(): array
    {
        $api_key = config('services.news_api.key');
        $newsApi = new NewsApi($api_key);
        try {
            $response = $newsApi->getTopHeadlines(
                country: 'us',
                page_size: 100,
                page: 1
            );
            if ($response->status !== 'ok' || empty($response->articles)) {
                Log::warning('NewsAPI: No top headlines found');

                return [];
            }

            return array_map([$this->newsApi, 'transform'], $response->articles);
        } catch (Exception $exception) {
            Log::error('NewsAPI fetch failed', ['error' => $exception->getMessage()]);

            return [];
        }
    }
}
