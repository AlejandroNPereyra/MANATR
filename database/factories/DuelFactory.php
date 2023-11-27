<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Providers\FantasyPlaceProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Duel>
 */
class DuelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FantasyPlaceProvider($this->faker));

        return [
            'date' => $this->faker->dateTimeBetween('2023-01-01', 'now'),
            'celebrated_at' => $this->faker->fantasyPlace(),
            'winner_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'loser_id' => function (array $attributes) {
                return User::where('id', '!=', $attributes['winner_id'])->inRandomOrder()->first()->id;
            },
            'winner_mana_raised' => $this->faker->numberBetween(0, 100),
            'loser_mana_raised' => function (array $attributes) {
                // Ensure loser's mana is always less than the winner's mana
                return $this->faker->numberBetween(0, $attributes['winner_mana_raised']);
            },
        ];
    }
}
