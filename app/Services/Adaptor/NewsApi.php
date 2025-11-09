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
            'title' => $article['title_text'],
            'snippet' => Str::limit($article['short_description'] ?? '', 500, '...'),
            'content' => $article['full_text'] ?? 'no content',
            'image' => $article['thumbnail'] ?? 'https://picsum.photos/600/250',
            'source' => SourceEnums::NEWS_API->value,
            'source_id' => $article['uid'],
            'author' => $article['author_name'] ?? 'no author',
            'category' => $article['category_name'] ?? null,
        ];
    }
}
