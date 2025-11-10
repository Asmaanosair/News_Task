<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;

class OpenNewsService implements NewsInterface
{
    public function fetchArticles(): array
    {
        return [
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
    }
}
