<?php

namespace App\DTOs;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

readonly class ArticleDTO
{
    public function __construct(
        public string $title,
        public string $snippet,
        public string $content,
        public string $image,
        public string $source,
        public string $source_id,
        public string $author,
        public ?string $category,
        public string $published_at,
    ) {
    }

    /**
     * Create DTO from array with validation
     * @throws ValidationException
     */
    public static function fromArray(array $data): self
    {
        $validated = self::validate($data);

        return new self(
            title: $validated['title'],
            snippet: $validated['snippet'] ?? '',
            content: $validated['content'] ?? '',
            image: $validated['image'],
            source: $validated['source'],
            source_id: $validated['source_id'],
            author: $validated['author'] ?? 'Unknown',
            category: $validated['category'] ?? null,
            published_at: $validated['published_at'] ?? now()->toISOString(),
        );
    }

    /**
     * Validate input data
     * @throws ValidationException
     */
    private static function validate(array $data): array
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|min:3|max:500',
            'snippet' => 'nullable|string|max:1000',
            'content' => 'nullable|string',
            'image' => 'required|url',
            'source' => 'required|string',
            'source_id' => 'required|string',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return $validator->validated();
    }

    /**
     * Convert DTO to array for database
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'snippet' => $this->snippet,
            'content' => $this->content,
            'image' => $this->image,
            'source' => $this->source,
            'source_id' => $this->source_id,
            'author' => $this->author,
            'category' => $this->category,
            'published_at' => $this->published_at,
        ];
    }
}
