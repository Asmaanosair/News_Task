<?php

namespace App\Traits;

trait searchTrait
{
    public function scopeKeyword($query, $keyword)
    {
        if (empty($this->searchColumns) || empty($keyword)) {
            return $query;
        }
        $columns = implode(',', $this->searchColumns);

        return $query->whereRaw("CONCAT_WS(' ', {$columns}) like '%{$keyword}%'");
    }
}
