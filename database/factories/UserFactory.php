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
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->text(),
            'email_verified_at' => now(),
            'password' => Hash::make('userpass123'), // Set the password field to 'userpass123'
            'remember_token' => Str::random(10),
            'wizardry' => $this->faker->numberBetween(0, 100),
            'duels_won' => $this->faker->numberBetween(0, 100),
            'duels_lost' => $this->faker->numberBetween(0, 60)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
