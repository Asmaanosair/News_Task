<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleFilterRequest;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    protected ArticleInterface $repository;

    public function __construct(ArticleInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/articles",
     *     operationId="getArticles",
     *     tags={"Articles"},
     *     summary="Get list of articles",
     *     description="Returns paginated list of articles with optional filters",
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Filter by article category",
     *         required=false,
     *         @OA\Schema(type="string", example="Technology")
     *     ),
     *     @OA\Parameter(
     *         name="source",
     *         in="query",
     *         description="Filter by source name",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"news_api", "news_cred", "open_news"},
     *             example=""
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="author",
     *         in="query",
     *         description="Filter by author name",
     *         required=false,
     *         @OA\Schema(type="string", example="")
     *     ),
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Filter by publication date (YYYY-MM-DD)",
     *         required=false,
     *         @OA\Schema(type="string", format="date", example="")
     *     ),
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Search keyword in title or content",
     *         required=false,
     *         @OA\Schema(type="string", example="")
     *     ),
     *     @OA\Parameter(
     *         name="orderBy",
     *         in="query",
     *         description="Sort by column name",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"published_at", "title", "created_at"},
     *             example=""
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="direction",
     *         in="query",
     *         description="Sort direction",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"asc", "desc"},
     *             example=""
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=null)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Breaking News Title"),
     *                     @OA\Property(property="snippet", type="string", example="This is a short snippet..."),
     *                     @OA\Property(property="content", type="string", example="Full article content..."),
     *                     @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
     *                     @OA\Property(property="source", type="string", example="news_api"),
     *                     @OA\Property(property="source_id", type="string", example="abc123"),
     *                     @OA\Property(property="author", type="string", example="John Doe"),
     *                     @OA\Property(property="category", type="string", example="Technology"),
     *                     @OA\Property(property="published_at", type="string", format="date-time", example="2025-11-09T12:00:00Z"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-11-09T12:00:00Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-11-09T12:00:00Z")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="object",
     *                 @OA\Property(property="first", type="string", example="http://localhost/api/articles?page=1"),
     *                 @OA\Property(property="last", type="string", example="http://localhost/api/articles?page=10"),
     *                 @OA\Property(property="prev", type="string", nullable=true),
     *                 @OA\Property(property="next", type="string", example="http://localhost/api/articles?page=2")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="from", type="integer", example=1),
     *                 @OA\Property(property="last_page", type="integer", example=10),
     *                 @OA\Property(property="per_page", type="integer", example=20),
     *                 @OA\Property(property="to", type="integer", example=20),
     *                 @OA\Property(property="total", type="integer", example=200)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function index(ArticleFilterRequest $request): AnonymousResourceCollection
    {
        $filters = $request->only(['category', 'source', 'author', 'date', 'keyword']);
        $perPage = $request->input('perPage', 20);
        $orderBy = $request->input('orderBy', 'published_at');
        $direction = $request->input('direction', 'desc');
        $articles = $this->repository->getArticles($filters, $perPage, $orderBy, $direction);

        return ArticleResource::collection($articles);
    }
}
