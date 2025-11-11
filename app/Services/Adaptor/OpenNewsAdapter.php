<?php

namespace App\Services\Adaptor;

use App\DTOs\ArticleDTO;
use App\Enums\SourceEnums;
use App\Interfaces\NewsAdapterInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OpenNewsAdapter implements NewsAdapterInterface
{
    /**
     * @param array|object  $article
     * @return array
     * @throws ValidationException
     */
    public function transform(array|object $article): array
    {
        return ArticleDTO::fromArray([
            'title' => $article['title'] ?? 'No Title',
            'snippet' => Str::limit($article['abstract'] ?? '', 500, '...'),
            'content' => $article['abstract'] ?? 'No content',
            'image' => $article['multimedia'][0]['url'] ?? 'https://picsum.photos/600/250',
            'source' => SourceEnums::OPEN_NEW->value,
            'source_id' => $article['uri'] ?? md5($article['url'] ?? uniqid()),
            'author' => str_replace('By ', '', $article['byline'] ?? 'Unknown'),
            'category' => $article['section'] ?? null,
            'published_at' => isset($article['published_date'])
                ? Carbon::parse($article['published_date'])->format('Y-m-d H:i:s')
                : now()->format('Y-m-d H:i:s'),
        ])->toArray();
    }
}
