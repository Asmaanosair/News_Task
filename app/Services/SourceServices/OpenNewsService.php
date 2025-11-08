<?php

namespace App\Services\SourceServices;

use App\Enums\SourceEnums;
use App\Interfaces\NewsInterface;
use Illuminate\Support\Facades\Http;

class OpenNewsService implements NewsInterface
{
    /**
     * @return array
     */
  public function fetchArticles(): array
  {
      return [
          ['id' => 1, 'title' => 'OpenNews', 'category' => 'Technology', 'author' => 'John'],
          ['id' => 2, 'title' => 'OpenNews', 'category' => 'Science', 'author' => 'Alice'],
      ];
  }
}
