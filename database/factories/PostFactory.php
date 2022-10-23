<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' =>fake()->jobTitle(),
            'description'=>fake()->realText(200),
            'user_id'=>ceil(rand(1,3)) ,
            'created_at'=>fake()->date('Y-m-d'),
            'updated_at'=>fake()->date('Y-m-d'),
        ];
    }
}
