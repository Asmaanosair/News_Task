<?php

namespace App\Services;

use App\Enums\SourceEnums;
use App\Services\SourceServices\NewsApiService;
use App\Services\SourceServices\NewsCredService;
use App\Services\SourceServices\OpenNewsService;
use InvalidArgumentException;

class SourceFactory
{
    public static function fromService($source): NewsApiService|OpenNewsService|NewsCredService
    {
        return match ($source) {
            SourceEnums::NEWS_API => new NewsApiService(),
            SourceEnums::NEWS_CRED => new NewsCredService(),
            SourceEnums::OPEN_NEW => new OpenNewsService(),
            default => throw new InvalidArgumentException("Unknown Source :  $source"),
        };
    }
}
