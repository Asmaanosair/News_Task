<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    protected ArticleInterface $repository;

    public function __construct(ArticleInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the articles.
     *
     * You can filter articles by providing any of the following optional query parameters:
     * - `category` (string): Filter by article category. Example: `Technology`
     * - `source` (string): Filter by source name. Example: `news_cred`
     * - `author` (string): Filter by author name. Example: `Sarah Lee`
     * - `date` (string - YYYY-MM-DD): Filter by publication date. Example: `2025-11-09`
     * - `keyword` (string): Search for keyword in title or content. Example: `AI`
     * - `orderBy` (string): Sort by column name. Example: `published_at`, `title`, `created_at`
     * * - `direction` (string): Sort direction ('asc' or 'desc'). Default: `desc`
     * * - `perPage` (int): Number of items per page. Default: `20`
     * *
     * Example request:
     * GET /api/articles?source=news_cred&category=Technology&keyword=AI&perPage=50
     * * GET /api/articles?orderBy=published_at&direction=desc&perPage=10
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->only(['category', 'source', 'author', 'date', 'keyword']);
        $articles = $this->repository->getArticles($filters);

        return ArticleResource::collection($articles);
    }
}
