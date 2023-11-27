<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Duel;

class DuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Duel::factory(2000)->create();
    }
}
