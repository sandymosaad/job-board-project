<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => $this->generatePhoneNumber(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'type' => $this->faker->randomElement(['employer', 'candidate']),
            'image' => $this->faker->imageUrl
        ];
    }

    private function generatePhoneNumber()
    {
        // Generate a number with exactly 11 digits
        $number = $this->faker->numerify('###########'); // 11 digits

        // Clean and ensure it's exactly 11 digits
        $cleanedNumber = preg_replace('/\D/', '', $number); // Remove any non-digit characters
        return str_pad(substr($cleanedNumber, 0, 11), 11, '0', STR_PAD_LEFT); // Ensure it's 11 digits
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
