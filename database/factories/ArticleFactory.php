<?php

namespace Database\Factories;

use App\Models\Article;
use App\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'subtitle' => $this->faker->sentence,
            'text' => $this->faker->paragraphs(25, true),
            'slug' => SlugService::decodeSlug($title)
        ];
    }
}
