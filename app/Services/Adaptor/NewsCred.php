<?php

namespace App\Services\Adaptor;

use App\Enums\SourceEnums;
use Illuminate\Support\Str;

class NewsCred
{
    /**
     * @param array $article
     * @return array
     */
    public function transform(array $article): array
    {
        return [
            'title' => $article['headline'],
            'snippet' => Str::limit($article['summary'] ?? '', 500, '...'),
            'content' => $article['body'] ?? 'no content',
            'image' => $article['image_url'] ?? 'https://picsum.photos/600/250',
            'source' => SourceEnums::NEWS_CRED->value,
            'source_id' => $article['article_id'],
            'author' => $article['writer'] ?? 'no author',
            'category' => $article['topic'] ?? null,
            'published_at' =>now()->toISOString(),
        ];
    }
}
