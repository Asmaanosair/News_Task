<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;
use App\Services\Adaptor\NewsApi;

class NewsApiService implements NewsInterface
{
    /**
     * @var NewsApi
     */
    protected NewsApi $newsApi;

    public function __construct()
    {
        $this->newsApi = new NewsApi();
    }

    public function fetchArticles(): array
    {
        $articles = [
            [
                'uid' => 501,
                'title_text' => 'Economy grows 5%',
                'short_description' => 'The global economy grew by 5% this year...',
                'full_text' => 'Detailed report on economic growth...',
                'thumbnail' => 'https://picsum.photos/600/250?opennews1',
                'author_name' => 'Emma Brown',
                'category_name' => 'Business',
            ],
            [
                'uid' => 502,
                'title_text' => 'Health benefits of meditation',
                'short_description' => 'Meditation can reduce stress and anxiety...',
                'full_text' => 'Complete article on meditation...',
                'thumbnail' => null,
                'author_name' => 'David Wilson',
                'category_name' => 'Health',
            ],
        ];

        return array_map([$this->newsApi, 'transform'], $articles);
    }
}
