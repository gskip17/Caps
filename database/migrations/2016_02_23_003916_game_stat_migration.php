<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GameStatMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_stats', function(Blueprint $table){
                    $table->increments('id')->index();
                    $table->integer('playerId')->nullable();
                    $table->integer('gameId')->nullable();
                    $table->integer('cupsMade')->nullable();
                    $table->boolean('outcome'); // True for win, false for loss
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
        Schema::drop('game_stats');
    }
}
