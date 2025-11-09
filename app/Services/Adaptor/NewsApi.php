<?php

namespace App\Services\Adaptor;

use App\Enums\SourceEnums;
use Illuminate\Support\Str;

class NewsApi
{
    /**
     * @param array $article
     * @return array
     */
    public function transform(array $article): array
    {
        return [
            'title' => $article['title'] ?? 'No Title',
            'snippet' => Str::limit($article['description'] ?? '', 500, '...'),
            'content' => $article['content'] ?? 'no content',
            'image' => $article['urlToImage'] ?? 'https://picsum.photos/600/250',
            'source' => SourceEnums::NEWS_API->value,
            'source_id' => md5($article['url'] ?? uniqid()),
            'author' => $article['author'] ?? 'Unknown',
            'category' => null,
            'published_at' => $article['publishedAt'] ?? now()->toISOString(),
        ];
    }
}
