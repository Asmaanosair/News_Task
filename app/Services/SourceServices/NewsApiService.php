<?php

namespace App\Services\SourceServices;

use App\Interfaces\NewsInterface;

class NewsApiService implements NewsInterface
{
    /**
     * @return array
     */
    public function fetchArticles(): array
    {
        return [
            ['id' => 1, 'title' => 'NewsApi', 'category' => 'Technology', 'author' => 'John'],
            ['id' => 2, 'title' => 'NewsApi', 'category' => 'Science', 'author' => 'Alice'],
        ];
    }
}
