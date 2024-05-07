<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'published_at' => now(),
            'image_1' => 'path/to/default/image_1.png',
            'image_2' => 'path/to/default/image_2.png',
            'image_3' => 'path/to/default/image_3.png',
            'image_4' => 'path/to/default/image_4.png',
            'image_5' => 'path/to/default/image_5.png',
            'user_id' => User::factory()->create()->id,
        ];
    }
}
