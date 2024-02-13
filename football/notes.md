### Define Databases and Migrations

php artisan make:model Team
php artisan make:model Player
php artisan make:model Match
php artisan make:model MatchResult


php artisan make:migration create_teams_table
php artisan make:migration create_players_table
php artisan make:migration create_matches_table
php artisan make:migration create_match_results_table

Teams
id, name, year_of_foundation


player
Players: id, name, surname, date_of_birth, team_id
example:
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->date('date_of_birth');
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });


footbal_matches
Matches: id, team1_id, team2_id, match_date, status (upcoming, played, etc.)


MatchResults
id, match_id, team1_score, team2_score


### Define Relationships
example
class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'year_of_foundation'];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function matches()
    {
        return $this->hasMany(FootballMatch::class, 'team1_id')->orWhere('team2_id', $this->id);
    }
}



