<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 teams
        for ($i = 0; $i < 10; $i++) {
            Team::create([
                'name' => $faker->company,
                'year_of_foundation' => $faker->numberBetween(1863, 2024),
            ]);
        }
    }
}