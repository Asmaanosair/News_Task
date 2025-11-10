<?php

namespace Feature;

use App\Models\Article;
use App\Repository\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ArticleRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new ArticleRepository(new Article());
    }

    /**
     * Test insertOrUpdate creates new articles
     */
    public function test_insert_or_update_creates_new_articles(): void
    {
        $data = [
            [
                'title' => 'Article 1',
                'snippet' => 'Snippet 1',
                'content' => 'Content 1',
                'image' => 'https://example.com/1.jpg',
                'source' => 'news_api',
                'source_id' => 'test001',
                'author' => 'John Doe',
                'category' => 'Technology',
                'published_at' => now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Article 2',
                'snippet' => 'Snippet 2',
                'content' => 'Content 2',
                'image' => 'https://example.com/2.jpg',
                'source' => 'news_api',
                'source_id' => 'test002',
                'author' => 'Jane Smith',
                'category' => 'Sports',
                'published_at' => now()->format('Y-m-d H:i:s'),
            ],
        ];

        $result = $this->repository->insertOrUpdate($data);

        $this->assertCount(2, $result);
        $this->assertDatabaseCount('articles', 2);
    }

    /**
     * Test insertOrUpdate updates existing articles
     */
    public function test_insert_or_update_updates_existing_articles(): void
    {
        Article::create([
            'title' => 'Old Title',
            'source' => 'news_api',
            'source_id' => 'test003',
            'content' => 'Old content',
            'published_at' => now(),
        ]);

        $data = [
            [
                'title' => 'New Title',
                'snippet' => 'New snippet',
                'content' => 'New content',
                'image' => 'https://example.com/new.jpg',
                'source' => 'news_api',
                'source_id' => 'test003',
                'author' => 'Updated Author',
                'category' => 'Updated Category',
                'published_at' => now()->format('Y-m-d H:i:s'),
            ],
        ];

        $this->repository->insertOrUpdate($data);

        $this->assertDatabaseCount('articles', 1);
        $this->assertDatabaseHas('articles', [
            'title' => 'New Title',
            'source' => 'news_api',
            'source_id' => 'test003',
        ]);
    }

    /**
     * Test getArticles filters by category
     */
    public function test_get_articles_filters_by_category(): void
    {
        Article::factory()->create(['category' => 'Technology']);
        Article::factory()->create(['category' => 'Sports']);
        Article::factory()->create(['category' => 'Technology']);

        $result = $this->repository->getArticles(['category' => 'Technology']);

        $this->assertEquals(2, $result->total());
    }

    /**
     * Test getArticles filters by source
     */
    public function test_get_articles_filters_by_source(): void
    {
        Article::factory()->create(['source' => 'news_api']);
        Article::factory()->create(['source' => 'news_cred']);
        Article::factory()->create(['source' => 'news_api']);

        $result = $this->repository->getArticles(['source' => 'news_api']);

        $this->assertEquals(2, $result->total());
    }

    /**
     * Test getArticles filters by author
     */
    public function test_get_articles_filters_by_author(): void
    {
        Article::factory()->create(['author' => 'John Doe']);
        Article::factory()->create(['author' => 'Jane Smith']);
        Article::factory()->create(['author' => 'John Doe']);

        $result = $this->repository->getArticles(['author' => 'John Doe']);

        $this->assertEquals(2, $result->total());
    }

    /**
     * Test getArticles filters by date
     */
    public function test_get_articles_filters_by_date(): void
    {
        $today = now()->format('Y-m-d');
        $yesterday = now()->subDay()->format('Y-m-d');

        Article::factory()->create(['published_at' => $today]);
        Article::factory()->create(['published_at' => $yesterday]);

        $result = $this->repository->getArticles(['date' => $today]);

        $this->assertEquals(1, $result->total());
    }

    /**
     * Test getArticles filters by keyword
     */
    public function test_get_articles_filters_by_keyword(): void
    {
        Article::factory()->create(['title' => 'AI Technology']);
        Article::factory()->create(['title' => 'Sports News']);

        $result = $this->repository->getArticles(['keyword' => 'AI']);

        $this->assertEquals(1, $result->total());
    }
}
