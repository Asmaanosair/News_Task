<?php

namespace App\Services;

use App\Interfaces\NewsInterface;

class SourceService
{
    protected NewsInterface $provider;

    public function __construct(NewsInterface $provider)
    {
        $this->provider = $provider;
    }

    public function InsertArticles(): array
    {
        $data = $this->provider->fetchArticles();

        return $data;
    }
}
