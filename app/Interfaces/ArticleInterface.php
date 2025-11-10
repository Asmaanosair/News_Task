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

    /**
     * @param array $filters
     * @param int $perPage
     * @param string $orderBy
     * @param string $direction
     * @return LengthAwarePaginator
     */
    public function getArticles(array $filters = [], int $perPage = 20, string $orderBy = 'published_at', string $direction = 'desc'): LengthAwarePaginator;

    /**
     * @param $orderBy
     * @param $direction
     * @return Builder
     */
    public function orderBy($orderBy, $direction): Builder;
}
