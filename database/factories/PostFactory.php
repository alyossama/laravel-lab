<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
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
        $jobTitle = fake()->jobTitle();
        $users = User::all();
        return [
            'title' =>$jobTitle,

            'slug' =>Str::slug($jobTitle),
            'description'=>fake()->realText(200),
            'user_id'=>ceil(rand(1, count($users))) ,
            'created_at'=>fake()->date('Y-m-d'),
            'updated_at'=>fake()->date('Y-m-d'),
        ];
    }
}
