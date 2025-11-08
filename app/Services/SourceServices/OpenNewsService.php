<?php

namespace App\Services\SourceServices;

use App\Interfaces\NewsInterface;

class OpenNewsService implements NewsInterface
{
    public function fetchArticles(): array
    {
        return [
            ['id' => 1, 'title' => 'OpenNews', 'category' => 'Technology', 'author' => 'John'],
            ['id' => 2, 'title' => 'OpenNews', 'category' => 'Science', 'author' => 'Alice'],
        ];
    }
}
