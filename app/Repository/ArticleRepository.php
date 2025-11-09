<?php

namespace App\Repository;

use App\Interfaces\ArticleInterface;
use App\Models\Article;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * @return array|void
     */
    public function insertOrUpdate($data)
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
        } catch (Exception $e) {
            Log::error('ArticleRepository: Failed to insert articles', ['error' => $e->getMessage()]);
        }
    }

    public function getArticles(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = $this->query;
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

        return $this->orderBy()->paginate($perPage);
    }

    public function search($keyword)
    {
        return $this->query->keyword($keyword);
    }

    public function orderBy(): Builder
    {
        return $this->query->orderBy('published_at', 'desc');
    }
}
