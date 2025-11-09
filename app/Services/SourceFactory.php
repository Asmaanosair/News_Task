<?php

namespace App\Services;

use App\Enums\SourceEnums;
use App\Services\Strategy\NewsApiService;
use App\Services\Strategy\NewsCredService;
use App\Services\Strategy\OpenNewsService;
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
