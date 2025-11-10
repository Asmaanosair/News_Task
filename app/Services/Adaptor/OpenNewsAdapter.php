<?php

namespace App\Services\Adaptor;

use App\DTOs\ArticleDTO;
use App\Enums\SourceEnums;
use App\Interfaces\NewsAdapterInterface;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OpenNewsAdapter implements NewsAdapterInterface
{
    /**
     * @param array $article
     * @return array
     * @throws ValidationException
     */
    public function transform(array $article): array
    {
        return ArticleDTO::fromArray([
            'title' => $article['title'] ?? 'no title',
            'snippet' => Str::limit($article['description'] ?? '', 500, '...'),
            'content' => $article['content'] ?? 'no content',
            'image' => $article['urlToImage'] ?? 'https://picsum.photos/600/250',
            'source' =>SourceEnums::OPEN_NEW->value,
            'source_id' => $article['id'],
            'author' => $article['author'] ?? 'no author',
            'category' => $article['category'] ?? null,
            'published_at' => now()->format('Y-m-d H:i:s'),
        ])->toArray();
    }
}
