<?php

namespace App\Services;

use App\Interfaces\NewsInterface;

class SourceService
{
    protected NewsInterface $provider;

    /**
     * @param NewsInterface $provider
     */
    public function __construct(NewsInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return array
     */
    public function InsertArticles() : array
    {
        $data =$this->provider->fetchArticles();
        return $data;
    }

}
