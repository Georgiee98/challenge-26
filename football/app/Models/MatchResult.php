<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FootballMatch;

class MatchResult extends Model
{
    use HasFactory;

    protected $fillable = ['match_id', 'team1_score', 'team2_score'];

    public function match()
    {
        return $this->belongsTo(FootballMatch::class);
    }
}