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
        return [
            ['id' => 1, 'title' => 'NewsApi', 'category' => 'Technology', 'author' => 'John'],
            ['id' => 2, 'title' => 'NewsApi', 'category' => 'Science', 'author' => 'Alice'],
        ];
    }
}
