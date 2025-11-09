<?php

namespace App\Services\Strategy;

use App\Interfaces\NewsInterface;
use App\Services\Adaptor\NewsCred;

class NewsCredService implements NewsInterface
{
    /**
     * @var NewsCred
     */
    protected NewsCred $newsCred;

    public function __construct()
    {
        $this->newsCred = new NewsCred();
    }

    public function fetchArticles(): array
    {
        return [
            ['id' => 1, 'title' => 'NewsCred', 'category' => 'Technology', 'author' => 'John'],
            ['id' => 2, 'title' => 'NewsCred', 'category' => 'Science', 'author' => 'Alice'],
        ];
    }
}
