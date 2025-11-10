<?php

namespace App\Services\Adaptor;

use App\DTOs\ArticleDTO;
use App\Enums\SourceEnums;
use App\Interfaces\NewsAdapterInterface;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewsCredAdapter implements NewsAdapterInterface
{
    /**
     * @param array $article
     * @return array
     * @throws ValidationException
     */
    public function transform(array $article): array
    {
        return ArticleDTO::fromArray([
            'title' => $article['headline'],
            'snippet' => Str::limit($article['summary'] ?? '', 500, '...'),
            'content' => $article['body'] ?? 'no content',
            'image' => $article['image_url'] ?? 'https://picsum.photos/600/250',
            'source' => SourceEnums::NEWS_CRED->value,
            'source_id' => $article['article_id'],
            'author' => $article['writer'] ?? 'no author',
            'category' => $article['topic'] ?? null,
            'published_at' =>now()->format('Y-m-d H:i:s'),
        ])->toArray();
    }
}
