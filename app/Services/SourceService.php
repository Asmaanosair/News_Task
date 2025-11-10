<?php

namespace App\Services;

use App\Enums\SourceEnums;
use App\Interfaces\ArticleInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

readonly class SourceService
{
    /**
     * @param ArticleInterface $repository
     */
    public function __construct(
        private ArticleInterface $repository
    ) {}

    /**
     * @param SourceEnums $source
     * @return array
     */
    public function insertArticles(SourceEnums $source): array
    {
        $provider = SourceFactory::fromService($source->value);
        $articles = $provider->fetchArticles();
        $adapter = AdapterFactory::fromAdapter($source->value);
        $data = $this->transformWithValidation($articles, $adapter, $source);
        $validData = array_filter($data);
        if (!empty($validData)) {
            $this->repository->insertOrUpdate($validData);
        }
        Log::info("Articles processed from {$source->value}", [
            'total' => count($articles),
            'valid' => count($validData),
            'failed' => count($articles) - count($validData)
        ]);

        return $validData;
    }

    /**
     * @param array $articles
     * @param object $adapter
     * @param SourceEnums $source
     * @return array
     */

    private function transformWithValidation(array $articles, object $adapter, SourceEnums $source): array
    {
        return array_map(function ($article) use ($adapter, $source) {
            try {
                return $adapter->transform($article);
            } catch (ValidationException $e) {
                Log::warning("Validation failed from {$source->value}", $e->errors());
                return null;
            }
        }, $articles);
    }
}
