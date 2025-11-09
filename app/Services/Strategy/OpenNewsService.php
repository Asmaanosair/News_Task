<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;
use App\Services\Adaptor\OpenNews;

class OpenNewsService implements NewsInterface
{
    /**
     * @var OpenNews
     */
    protected OpenNews $openNews;

    public function __construct()
    {
        $this->openNews = new OpenNews();
    }

    public function fetchArticles(): array
    {
        $articles = [
            [
                'id' => 1,
                'title' => 'Tesla launches new model',
                'description' => 'Tesla has launched its new electric car...',
                'content' => 'Full content of the Tesla article...',
                'urlToImage' => 'https://picsum.photos/600/250?newsapi1',
                'author' => 'John Doe',
                'category' => 'Technology',
            ],
            [
                'id' => 2,
                'title' => 'SpaceX rocket launch success',
                'description' => 'SpaceX launched a new rocket...',
                'content' => 'Full content of SpaceX article...',
                'urlToImage' => null,
                'author' => 'Alice Smith',
                'category' => 'Science',
            ],
        ];

        return array_map([$this->openNews, 'transform'], $articles);
    }
}
