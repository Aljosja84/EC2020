<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->dateTime('game_date');
            $table->unsignedBigInteger('api_id');
            $table->unsignedBigInteger('stadium_id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('home_team_score');
            $table->unsignedBigInteger('away_team_id');
            $table->unsignedBigInteger('away_team_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
