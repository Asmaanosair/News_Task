<?php

namespace App\Http\Repository;

use App\Interfaces\ArticleInterface;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleInterface
{
    public function InsertOrUpdate($data): void
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
