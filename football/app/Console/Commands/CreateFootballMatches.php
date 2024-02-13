<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FootballMatch;
use App\Models\Team;
use Carbon\Carbon;

class CreateFootballMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-football-matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a football match every minute with random teams';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        // Assume you have at least two teams in your database
        $teams = Team::inRandomOrder()->take(2)->get();

        if ($teams->count() < 2) {
            $this->error('Not enough teams to create a match.');
            return;
        }

        $match = FootballMatch::create([
            'team1_id' => $teams[0]->id,
            'team2_id' => $teams[1]->id,
            'match_date' => Carbon::now(),
            'status' => 'scheduled', // Use 'scheduled' for newly created matches
        ]);

        $this->info("Match between {$teams[0]->name} and {$teams[1]->name} has been created.");
    }
}