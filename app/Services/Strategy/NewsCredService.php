<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;

class NewsCredService implements NewsInterface
{
    public function fetchArticles(): array
    {
        return [
            [
                'article_id' => 'NC-101',
                'headline' => 'Global Warming Update',
                'summary' => 'A recent study shows climate change impact...',
                'body' => 'Full content on climate change...',
                'image_url' => 'https://picsum.photos/600/250?newscred1',
                'writer' => 'Michael Johnson',
                'topic' => 'Environment',
                'date_published' => '2024-12-20T09:00:00Z',
            ],
            [
                'article_id' => 'NC-102',
                'headline' => 'New AI breakthrough',
                'summary' => 'AI researchers developed a new algorithm...',
                'body' => 'Full article about AI algorithm...',
                'image_url' => null,
                'writer' => 'Sarah Lee',
                'topic' => 'Technology',
                'date_published' => '2024-12-19T12:00:00Z',
            ],
        ];
    }
}
