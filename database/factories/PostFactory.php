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
    public function definition(): array
    {
        return [
            
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
            'workType' => $this->faker->randomElement(['remote', 'onsite', 'hybrid']),
            'location' => $this->faker->city,
            'skills' => $this->faker->words(3, true),
            'salaryRange' => $this->faker->randomElement(['$40,000 - $50,000', '$50,000 - $60,000', '$60,000 - $70,000']),
            'benefites' => $this->faker->text,
            'logo' => $this->faker->imageUrl,
            'category' => $this->faker->word,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
