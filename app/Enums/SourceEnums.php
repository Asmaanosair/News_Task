<?php

namespace App\Enums;

use App\Services\SourceServices\NewsApiService;
use App\Services\SourceServices\NewsCredService;
use App\Services\SourceServices\OpenNewsService;

enum SourceEnums: string
{
    case NEWS_API='news_api';
    case NEWS_CRED='news_cred';
    case OPEN_NEW='open_new';
}
