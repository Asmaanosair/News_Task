<?php

namespace App\Services\Adaptor;

use App\DTOs\ArticleDTO;
use App\Enums\SourceEnums;
use App\Interfaces\NewsAdapterInterface;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewsApiAdapter implements NewsAdapterInterface
{
    /**
     * @param array|object $article
     * @return array
     * @throws ValidationException
     */
    public function transform(array|object $article): array
    {
        $article = (array) $article;

        return ArticleDTO::fromArray([
            'title' => $article['title'] ?? 'No Title',
            'snippet' => Str::limit($article['description'] ?? '', 500, '...'),
            'content' => $article['content'] ?? 'no content',
            'image' => $article['urlToImage'] ?? 'https://picsum.photos/600/250',
            'source' => SourceEnums::NEWS_API->value,
            'source_id' => md5($article['url'] ?? uniqid()),
            'author' => $article['author'] ?? 'Unknown',
            'category' => null,
            'published_at' => Carbon::parse($article['publishedAt'])->format('Y-m-d H:i:s'),
        ])->toArray();
    }
}
