<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
});
