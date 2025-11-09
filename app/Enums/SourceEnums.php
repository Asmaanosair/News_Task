<?php

namespace App\Enums;

enum SourceEnums: string
{
     const NEWS_API = 'news_api';
     const NEWS_CRED = 'news_cred';
    const OPEN_NEW = 'open_new';

    const SOURCE_TYPE =[
        self::NEWS_API,
        self::NEWS_CRED,
        self::OPEN_NEW,
    ];
}
