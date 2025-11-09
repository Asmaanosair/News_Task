<?php

namespace App\Interfaces;

interface ArticleInterface
{
    /**
     * @param $data
     */
    public function insertOrUpdate($data);

    public function getArticles(array $filters = [], int $perPage = 20);

    public function search($keyword);

    public function orderBy();
}
