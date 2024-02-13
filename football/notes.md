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


### Seed Admin User
extend user tho..
php artisan make:migration update_user_table --table=users
add role
     Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user');
        });

php artisan make:seeder AdminsTableSeeder
php artisan db:seed --class=AdminsTableSeeder

       DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        -   dont forget imports Hash, DB


### Addd middleware
php artisan make:middleware IsAdminMiddleware

        if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Redirect non-admins somewhere else or abort
        return redirect('/')->with('error', 'You do not have access to this section.');

        In our case we use this snippet below not the one above

                // Check if logged in and role is admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect or abort for non-admin users
        return redirect('/')->with('error', 'You do not have access to this section.')


app/Http/Kernel.php
add ub middlewareAlliases ⬇️
    protected $middlewareAliases = [
        'is_admin' => \App\Http\Middleware\IsAdminMiddleware::class,


