<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * @mixin Article
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'snippet' => $this->snippet,
            'content' => $this->content,
            'image' => $this->image,
            'source' => $this->source,
            'source_id' => $this->source_id,
            'author' => $this->author,
            'category' => $this->category,
            'published_date' => $this->created_at,
        ];
    }
}
