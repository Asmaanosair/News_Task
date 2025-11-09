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
            SourceEnums::NEWS_API->value => new NewsApiService(),
            SourceEnums::NEWS_CRED->value => new NewsCredService(),
            SourceEnums::OPEN_NEW->value => new OpenNewsService(),
            default => throw new InvalidArgumentException("Unknown Source :  $source"),
        };
    }
}
