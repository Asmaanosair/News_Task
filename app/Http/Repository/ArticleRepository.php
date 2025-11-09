<?php

namespace App\Http\Repository;

use App\Interfaces\ArticleInterface;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleInterface
{
    /**
     * @param $data
     * @return true
     */
    public function insertOrUpdate($data): true
    {
        $chunkSize = 1000;
            foreach (array_chunk($data, $chunkSize) as $chunk) {
                DB::table('articles')->upsert(
                    $chunk,
                    ['source', 'source_id'],
                    ['title', 'snippet', 'content', 'image', 'author', 'category']
                );
            }
            return true;
    }
}
