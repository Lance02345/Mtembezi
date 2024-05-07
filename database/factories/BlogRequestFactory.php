<?php

namespace Database\Factories;

use App\Models\BlogRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                // Retrieve a random user ID from the User model
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
