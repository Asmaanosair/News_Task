<?php

namespace App\Interfaces;

interface NewsAdapterInterface
{
    /**
     * @param array $article
     * @return array
     */
    public function transform(array $article): array;
}
