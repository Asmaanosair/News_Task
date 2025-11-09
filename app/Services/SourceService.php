<?php

namespace App\Services;

use App\Interfaces\ArticleInterface;
use App\Interfaces\NewsInterface;

class SourceService
{
    protected NewsInterface $provider;
    protected ArticleInterface $repository;

    /**
     * @param NewsInterface $provider
     */
    public function __construct(NewsInterface $provider)
    {
        $this->provider = $provider;
        $this->repository = app(ArticleInterface::class);
    }

    /**
     * @return array
     */
    public function insertArticles(): array
    {
        $data = $this->provider->fetchArticles();
        $this->repository->insertOrUpdate($data);

        return $data;
    }
}
