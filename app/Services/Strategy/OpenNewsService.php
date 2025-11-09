<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;
use App\Services\Adaptor\OpenNews;

class OpenNewsService implements NewsInterface
{
    /**
     * @var OpenNews
     */
    protected OpenNews $openNews;

    public function __construct()
    {
        $this->openNews = new OpenNews();
    }

    public function fetchArticles(): array
    {
        return [
            ['id' => 1, 'title' => 'OpenNews', 'category' => 'Technology', 'author' => 'John'],
            ['id' => 2, 'title' => 'OpenNews', 'category' => 'Science', 'author' => 'Alice'],
        ];
    }
}
