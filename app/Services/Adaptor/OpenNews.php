<?php

namespace App\Services\Adaptor;

use App\Enums\SourceEnums;
use Illuminate\Support\Str;

class OpenNews
{
    /**
     * @param array $article
     * @return array
     */
    public function transform(array $article): array
    {
        return [
            'title' => $article['title'] ?? 'no title',
            'snippet' => Str::limit($article['description'] ?? '', 500, '...'),
            'content' => $article['content'] ?? 'no content',
            'image' => $article['urlToImage'] ?? 'https://picsum.photos/600/250',
            'source' =>SourceEnums::OPEN_NEW->value,
            'source_id' => $article['id'],
            'author' => $article['author'] ?? 'no author',
            'category' => $article['category'] ?? null,
            'published_at' => now()->toISOString(),
        ];
    }
}
