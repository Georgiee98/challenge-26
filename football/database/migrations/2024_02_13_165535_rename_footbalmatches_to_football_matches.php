<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFootbalmatchesToFootballMatches extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('footbalmatches', 'football_matches');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::rename('football_matches', 'footbalmatches');
    }
}