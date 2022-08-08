<?php

namespace Database\Factories;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $title = $this->faker->sentence(6, true);
        $slug = Str::substr(Str::lower(preg_replace('/\s+/', '-', $title)), 0, -1);
        return [
            'title' => $title,
            'body' => $this->faker->paragraph(100, true),
            'slug' => $slug,
            'img'=> 'https://p4.wallpaperbetter.com/wallpaper/801/330/425/laravel-php-code-simple-wallpaper-preview.jpg',
            'created_at'=> $this->faker->dateTimeBetween('-1 years'),
            'published_at'=> Carbon::now()
        ];
    }
}
