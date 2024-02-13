<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\MatchResult;

class FootballMatch extends Model
{
    use HasFactory;

    protected $table = 'football_matches';
    protected $fillable = ['team1_id', 'team2_id', 'match_date', 'status'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'matches', 'team1_id', 'team2_id');
    }

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function matchResult()
    {
        return $this->hasOne(MatchResult::class);
    }


}