<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\Team;
use Faker\Factory as Faker;

class PlayersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all teams
        $teams = Team::all();

        // Generate players for each team
        foreach ($teams as $team) {
            // Generate between 11 to 25 players for each team
            $numPlayers = $faker->numberBetween(11, 25);

            for ($i = 0; $i < $numPlayers; $i++) {
                Player::create([
                    'name' => $faker->firstName,
                    'surname' => $faker->lastName,
                    'date_of_birth' => $faker->date(),
                    'team_id' => $team->id,
                ]);
            }
        }
    }
}