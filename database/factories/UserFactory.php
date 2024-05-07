<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Default password, change as needed
            'phone_number' => $this->faker->phoneNumber,
            'avatar' => 'path/to/default/avatar.png', // Default avatar path
            'role' => 'user', // Default role
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user's role is admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin()
    {
        return $this->state([
            'role' => 'admin',
        ]);
    }
}
