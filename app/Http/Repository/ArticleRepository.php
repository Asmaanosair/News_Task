<?php

namespace App\Http\Repository;

use App\Interfaces\ArticleInterface;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleInterface
{
    /**
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function insertOrUpdate($data): bool
    {
        if (empty($data)) {
            return false;
        }
        try {
            DB::transaction(function () use ($data) {
                foreach (array_chunk($data, 1000) as $chunk) {
                    DB::table('articles')->upsert(
                        $chunk,
                        ['source', 'source_id'],
                        ['title', 'snippet', 'content', 'image', 'author', 'category']
                    );
                }
            });

            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to insert articles', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
