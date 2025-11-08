<?php

namespace App\Interfaces;

interface NewsInterface
{
    /**
     * @return array
     */
    public function fetchArticles(): array;
}
