<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FootballMatch;
use App\Models\Team;
use App\Models\Player;
use App\Models\MatchResult;
use Faker\Factory as Faker;

class UpdateMatchResults extends Command
{
    protected $signature = 'app:update-match-results';
    protected $description = 'Update football match results for the past 24 hours with random outcomes';

    public function handle()
    {
        $faker = Faker::create();

        // Get matches that are happening now (within a certain time frame)
        $matches = FootballMatch::where('match_date', '>=', now()->subMinutes(1)) // Adjust time frame as needed
            ->where('match_date', '<=', now()) // Assuming matches last for 90 minutes
            ->where('status', '!=', 'finished')
            ->get();

        foreach ($matches as $match) {
            // Generate random scores
            $team1_score = rand(0, 5);
            $team2_score = rand(0, 5);

            // Update the match status
            $match->status = 'finished';
            $match->save();

            // Validate if teams are set for the match
            if ($match->team1 && $match->team2) {
                // Store detailed match results
                $matchResult = MatchResult::create([
                    'match_id' => $match->id,
                    'team1_score' => $team1_score,
                    'team2_score' => $team2_score,
                ]);

                // Simulate player scores
                $team1Players = $match->team1->players;
                $team2Players = $match->team2->players;

                foreach ($team1Players as $player) {
                    $playerScore = rand(0, 5); // Assumption: Players can score up to 5 goals
                    $matchResult->playerScores()->create([
                        'player_id' => $player->id,
                        'team_id' => $match->team1_id,
                        'goals_scored' => $playerScore,
                    ]);
                }

                foreach ($team2Players as $player) {
                    $playerScore = rand(0, 5); // Assumption: Players can score up to 5 goals
                    $matchResult->playerScores()->create([
                        'player_id' => $player->id,
                        'team_id' => $match->team2_id,
                        'goals_scored' => $playerScore,
                    ]);
                }
            }
        }

        $this->info('Match results updated successfully.');
    }

}