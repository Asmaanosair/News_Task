<?php

namespace App\Http\Repository;

use App\Interfaces\ArticleInterface;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function insertOrUpdate($data): mixed
    {
        $chunkSize = 1000;
        foreach (array_chunk($data, $chunkSize) as $chunk) {
            DB::table('articles')->upsert(
                $chunk,
                ['source_name', 'source_id'],
                ['category', 'author', 'published_at', 'title']
            );
        }
    }
}
