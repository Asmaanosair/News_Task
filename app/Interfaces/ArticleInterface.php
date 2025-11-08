<?php

namespace App\Interfaces;

interface ArticleInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function InsertOrUpdate($data): mixed;
}
