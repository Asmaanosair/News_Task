<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'news_api' => [
        'key' => env('NEWS_API_KEY'),
        'sources' => env('NEWS_API_SOURCES', 'bbc-news,cnn,the-guardian'),
        'language' => env('NEWS_API_LANGUAGE', 'en'),
        'page_size' => env('NEWS_API_PAGE_SIZE', 100),
        'days_back' => env('NEWS_API_DAYS_BACK', 7),
    ],

    'news_cred' => [
        'key' => env('NEWS_CRED_API_KEY'),
        'base_url' => env('NEWS_CRED_BASE_URL', 'https://api.newscred.com'),
    ],

    'open_news' => [
        'key' => env('OPEN_NEWS_API_KEY'),
        'base_url' => env('OPEN_NEWS_BASE_URL', 'https://api.opennews.com'),
    ],

];
