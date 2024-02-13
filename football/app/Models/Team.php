<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FootballMatch;
use App\Models\Player;

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