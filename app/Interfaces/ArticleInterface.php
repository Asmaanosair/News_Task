<?php

namespace App\Interfaces;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ArticleInterface
{
    /**
     * @param $data
     */
    public function insertOrUpdate($data): array;

    public function getArticles(array $filters = [], int $perPage = 20, string $orderBy = 'published_at', string $direction = 'desc'): LengthAwarePaginator;

    public function search($keyword): Builder;

    public function orderBy($orderBy, $direction): Builder;
}
