<?php

namespace App\Services;

use App\Enums\SourceEnums;
use App\Interfaces\ArticleInterface;

class SourceService
{
    private ArticleInterface $repository;

    public function __construct(ArticleInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param SourceEnums $source
     * @return array
     */
    public function insertArticles(SourceEnums $source): array
    {
        $provider = SourceFactory::fromService($source->value);
        $articles = $provider->fetchArticles();
        $adapter = SourceFactory::fromAdapter($source->value);
        $data = array_map([$adapter, 'transform'], $articles);
        $this->repository->insertOrUpdate($data);

        return $data;
    }
}
