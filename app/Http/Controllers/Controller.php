<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="News Aggregator API",
 *     description="API documentation for News Aggregator Application",
 *     @OA\Contact(
 *         email="support@newsaggregator.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 * 
 * @OA\Tag(
 *     name="Articles",
 *     description="API Endpoints for managing articles"
 * )
 */
abstract class Controller
{
    //
}
