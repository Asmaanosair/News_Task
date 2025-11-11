<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Create test articles
        Article::factory()->count(5)->create([
            'category' => 'Technology',
            'source' => 'news_api',
        ]);
        
        Article::factory()->count(3)->create([
            'category' => 'Business',
            'source' => 'news_cred',
        ]);
        
        Article::factory()->count(2)->create([
            'category' => 'Sports',
            'source' => 'open_news',
            'author' => 'John Doe',
        ]);
    }

    public function test_can_get_all_articles(): void
    {
        $response = $this->getJson('/api/articles');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'snippet',
                        'content',
                        'image',
                        'source',
                        'source_id',
                        'author',
                        'category',
                        'published_date',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);

        $this->assertEquals(10, $response->json('meta.total'));
    }

    public function test_can_filter_articles_by_category(): void
    {
        $response = $this->getJson('/api/articles?category=Technology');

        $response->assertStatus(200);
        $this->assertEquals(5, $response->json('meta.total'));
        
        foreach ($response->json('data') as $article) {
            $this->assertEquals('Technology', $article['category']);
        }
    }

    public function test_can_filter_articles_by_source(): void
    {
        $response = $this->getJson('/api/articles?source=news_api');

        $response->assertStatus(200);
        $this->assertEquals(5, $response->json('meta.total'));
        
        foreach ($response->json('data') as $article) {
            $this->assertEquals('news_api', $article['source']);
        }
    }

    public function test_can_filter_articles_by_author(): void
    {
        $response = $this->getJson('/api/articles?author=John Doe');

        $response->assertStatus(200);
        $this->assertEquals(2, $response->json('meta.total'));
        
        foreach ($response->json('data') as $article) {
            $this->assertEquals('John Doe', $article['author']);
        }
    }

    public function test_can_filter_articles_by_date(): void
    {
        $article = Article::factory()->create([
            'published_at' => '2025-11-10 12:00:00',
        ]);

        $response = $this->getJson('/api/articles?date=2025-11-10');

        $response->assertStatus(200);
        $this->assertGreaterThanOrEqual(1, $response->json('meta.total'));
        
        $foundArticle = collect($response->json('data'))->firstWhere('id', $article->id);
        $this->assertNotNull($foundArticle);
    }

    public function test_can_search_articles_by_keyword(): void
    {
        Article::factory()->create([
            'title' => 'Laravel Framework Testing',
            'content' => 'This is about Laravel development',
        ]);

        $response = $this->getJson('/api/articles?keyword=Laravel');

        $response->assertStatus(200);
        $this->assertGreaterThanOrEqual(1, $response->json('meta.total'));
    }

    public function test_can_sort_articles_by_title_ascending(): void
    {
        $response = $this->getJson('/api/articles?orderBy=title&direction=asc');

        $response->assertStatus(200);
        
        $titles = collect($response->json('data'))->pluck('title')->toArray();
        $sortedTitles = $titles;
        sort($sortedTitles);
        
        $this->assertEquals($sortedTitles, $titles);
    }

    public function test_can_sort_articles_by_published_date_descending(): void
    {
        $response = $this->getJson('/api/articles?orderBy=published_at&direction=desc');

        $response->assertStatus(200);
        
        $dates = collect($response->json('data'))->pluck('published_at')->toArray();
        $sortedDates = $dates;
        rsort($sortedDates);
        
        $this->assertEquals($sortedDates, $dates);
    }

    public function test_can_paginate_articles(): void
    {
        $response = $this->getJson('/api/articles?perPage=5');

        $response->assertStatus(200);
        $this->assertEquals(5, $response->json('meta.per_page'));
        $this->assertCount(5, $response->json('data'));
    }

    public function test_can_get_second_page_of_articles(): void
    {
        $response = $this->getJson('/api/articles?perPage=5&page=2');

        $response->assertStatus(200);
        $this->assertEquals(2, $response->json('meta.current_page'));
        $this->assertCount(5, $response->json('data'));
    }

    public function test_can_combine_multiple_filters(): void
    {
        $response = $this->getJson('/api/articles?category=Technology&source=news_api&orderBy=title&direction=asc&perPage=3');

        $response->assertStatus(200);
        $this->assertEquals(3, $response->json('meta.per_page'));
        
        foreach ($response->json('data') as $article) {
            $this->assertEquals('Technology', $article['category']);
            $this->assertEquals('news_api', $article['source']);
        }
    }

    public function test_invalid_source_returns_validation_error(): void
    {
        $response = $this->getJson('/api/articles?source=invalid_source');

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => [
                    'source',
                ],
            ]);
    }

    public function test_invalid_date_format_returns_validation_error(): void
    {
        $response = $this->getJson('/api/articles?date=11-10-2025');

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => [
                    'date',
                ],
            ]);
    }

    public function test_invalid_order_by_returns_validation_error(): void
    {
        $response = $this->getJson('/api/articles?orderBy=invalid_column');

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => [
                    'orderBy',
                ],
            ]);
    }

    public function test_invalid_direction_returns_validation_error(): void
    {
        $response = $this->getJson('/api/articles?direction=invalid');

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => [
                    'direction',
                ],
            ]);
    }

    public function test_per_page_exceeds_maximum_returns_validation_error(): void
    {
        $response = $this->getJson('/api/articles?perPage=101');

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => [
                    'perPage',
                ],
            ]);
    }

    public function test_per_page_below_minimum_returns_validation_error(): void
    {
        $response = $this->getJson('/api/articles?perPage=0');

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => [
                    'perPage',
                ],
            ]);
    }

    public function test_returns_empty_result_when_no_articles_match_filter(): void
    {
        $response = $this->getJson('/api/articles?category=NonExistentCategory');

        $response->assertStatus(200);
        $this->assertEquals(0, $response->json('meta.total'));
        $this->assertEmpty($response->json('data'));
    }

    public function test_throttling_is_applied_to_articles_endpoint(): void
    {
        // Make 61 requests (limit is 60 per minute)
        for ($i = 0; $i < 61; $i++) {
            $response = $this->getJson('/api/articles');
            
            if ($i < 60) {
                $response->assertStatus(200);
            }
        }
        
        // The 61st request should be throttled
        $response->assertStatus(429);
    }
}

