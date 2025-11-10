<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class OpenNewsService implements NewsInterface
{
    /**
     * @return array
     */
    public function fetchArticles(): array
    {
        $apiKey = config('services.nyt_api.key');
        $baseUrl = config('services.nyt_api.base_url');
        $section = config('services.nyt_api.section');
        try {
            $response = Http::get("{$baseUrl}/{$section}.json", [
                'api-key' => $apiKey,
            ]);

            if ( ! $response->successful()) {
                Log::warning('NYT API: Request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            $data = $response->json();

            if (empty($data['results'])) {
                Log::warning('OpenNews: No articles found');

                return [];
            }

            return $data['results'];
        } catch (Throwable $e) {
            Log::error('OpenNews fetch failed');
            report($e);

            return [];
        }
    }
}
