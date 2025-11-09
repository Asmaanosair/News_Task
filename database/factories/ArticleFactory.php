<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(8),
            'snippet' => $this->faker->text(200),
            'content' => $this->faker->paragraphs(3, true),
            'image' => $this->faker->imageUrl(640, 480, 'news', true, 'Faker'),
            'source' => $this->faker->randomElement(['BBC', 'CNN', 'Reuters', 'Al Jazeera']),
            'source_id' => $this->faker->uuid(),
            'author' => $this->faker->name(),
            'category' => $this->faker->randomElement(['Technology', 'Business', 'Sports', 'Health']),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
