<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait searchTrait
{
    public function scopeKeyword($query, $keyword): Builder
    {
        if (empty($this->searchColumns) || empty($keyword)) {
            return $query;
        }
        $columns = implode(',', $this->searchColumns);

        return $query->whereRaw(
            "CONCAT_WS(' ', {$columns}) like ?",
            ["%{$keyword}%"]
        );
    }
}
