<?php

namespace App\Repository;

use App\Interfaces\ArticleInterface;
use App\Models\Article;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ArticleRepository implements ArticleInterface
{
    private Article $article;

    private Builder $query;

    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->query = $this->article->query();
    }

    /**
     * @param $data
     * @return array
     */
    public function insertOrUpdate($data): array
    {
        if (empty($data)) {
            return [];
        }
        try {
            DB::transaction(function () use ($data) {
                foreach (array_chunk($data, 1000) as $chunk) {
                    DB::table('articles')->upsert(
                        $chunk,
                        ['source', 'source_id'],
                        ['title', 'snippet', 'content', 'image', 'author', 'category', 'published_at']
                    );
                }
            });

            return $data;
        } catch (Throwable $e) {
            Log::error('Failed to insert articles ArticleRepository ');
            report($e);

            return [];
        }
    }

    /**
     * @param array $filters
     * @param int $perPage
     * @param string $orderBy
     * @param string $direction
     * @return LengthAwarePaginator
     */
    public function getArticles(array $filters = [], int $perPage = 20, string $orderBy = 'published_at', string $direction = 'desc'): LengthAwarePaginator
    {
        // Create fresh query instance to avoid state pollution
        $query = $this->article->newQuery();

        if ( ! empty($filters['category'])) {
            $query->category($filters['category']);
        }
        if ( ! empty($filters['source'])) {
            $query->source($filters['source']);
        }
        if ( ! empty($filters['author'])) {
            $query->author($filters['author']);
        }
        if ( ! empty($filters['date'])) {
            $query->date($filters['date']);
        }
        if ( ! empty($filters['keyword'])) {
            $query->keyword($filters['keyword']);
        }

        return $query->orderBy($orderBy, $direction)->paginate($perPage);
    }

    /**
     * @param $orderBy
     * @param $direction
     * @return Builder
     */
    public function orderBy($orderBy, $direction): Builder
    {
        return $this->query->orderBy($orderBy, $direction);
    }
}
