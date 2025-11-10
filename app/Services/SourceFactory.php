<?php

namespace App\Services;

use App\Enums\SourceEnums;
use App\Interfaces\NewsAdapterInterface;
use App\Interfaces\NewsInterface;
use App\Services\Adaptor\NewsApiAdapter;
use App\Services\Adaptor\NewsCredAdapter;
use App\Services\Adaptor\OpenNewsAdapter;
use App\Services\Strategy\NewsApiService;
use App\Services\Strategy\NewsCredService;
use App\Services\Strategy\OpenNewsService;
use InvalidArgumentException;

class SourceFactory
{
    public static function fromService($source): NewsInterface
    {
        return match ($source) {
            SourceEnums::NEWS_API->value => new NewsApiService(),
            SourceEnums::NEWS_CRED->value => new NewsCredService(),
            SourceEnums::OPEN_NEW->value => new OpenNewsService(),
            default => throw new InvalidArgumentException("Unknown Source :  $source"),
        };
    }

    public static function fromAdapter($source): NewsAdapterInterface
    {
        return match ($source) {
            SourceEnums::NEWS_API->value => new NewsApiAdapter(),
            SourceEnums::NEWS_CRED->value => new NewsCredAdapter(),
            SourceEnums::OPEN_NEW->value => new OpenNewsAdapter(),
            default => throw new InvalidArgumentException("Unknown Source :  $source"),
        };
    }
}
