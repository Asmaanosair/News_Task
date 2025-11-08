<?php

namespace App\Services\SourceServices;

use App\Interfaces\NewsInterface;

class NewsCredService implements NewsInterface
{
    /**
     * @return array
     */
    public function fetchArticles(): array
    {
        return [
            ['id' => 1, 'title' => 'NewsCred', 'category' => 'Technology', 'author' => 'John'],
            ['id' => 2, 'title' => 'NewsCred', 'category' => 'Science', 'author' => 'Alice'],
        ];
    }
}
