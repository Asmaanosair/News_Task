<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('articles')->middleware('throttle:60,1')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
});
