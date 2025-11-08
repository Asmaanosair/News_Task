<?php

namespace App\Interfaces;

interface NewsInterface
{
    /**
     * @return mixed
     */
    public function fetchArticles(): array;

}
