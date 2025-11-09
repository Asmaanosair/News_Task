<?php

namespace App\Models;

use App\Traits\searchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use searchTrait;

    protected array $searchColumns = ['category', 'source', 'title', 'author'];

    protected $fillable = [
        'title',
        'snippet',
        'content',
        'image',
        'source',
        'source_id',
        'author',
        'category',
        'published_at',
    ];

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeDate($query, $publishedAt)
    {
        return $query->whereDate('published_at', $publishedAt);
    }

    public function scopeSource($query, $source)
    {
        return $query->where('source', $source);
    }

    public function scopeAuthor($query, $source)
    {
        return $query->where('author', $source);
    }
}
