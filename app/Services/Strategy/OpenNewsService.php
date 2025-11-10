<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;

class OpenNewsService implements NewsInterface
{
    public function fetchArticles(): array
    {
        return [
            [
                'id' => "1",
                'title' => 'Tesla launches new model',
                'description' => 'Tesla has launched its new electric car...',
                'content' => 'Full content of the Tesla article...',
                'urlToImage' => 'https://picsum.photos/600/250?newsapi1',
                'url' => 'https://example.com/tesla-new-model',
                'author' => 'John Doe',
                'category' => 'Technology',
                'publishedAt' => '2025-11-10T12:00:00Z',
            ],
            [
                'id' => "2",
                'title' => 'SpaceX rocket launch success',
                'description' => 'SpaceX launched a new rocket...',
                'content' => 'Full content of SpaceX article...',
                'urlToImage' => 'https://picsum.photos/600/250?spacex',
                'url' => 'https://example.com/spacex-rocket-launch',
                'author' => 'Alice Smith',
                'category' => 'Science',
                'publishedAt' => '2025-11-09T15:30:00Z',
            ],
            [
                'id' => "3",
                'title' => 'AI breakthrough in healthcare',
                'description' => 'New AI system can detect diseases...',
                'content' => 'Full content of AI healthcare article...',
                'urlToImage' => 'https://picsum.photos/600/250?ai',
                'url' => 'https://example.com/ai-healthcare-breakthrough',
                'author' => 'Dr. Mohamed Ali',
                'category' => 'Health',
                'publishedAt' => '2025-11-08T09:15:00Z',
            ],
        ];
    }
}
