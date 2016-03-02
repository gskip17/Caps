<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchedulelistingMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_listings',function(Blueprint $table){
          $table->increments('id')->index();
          $table->integer('team1Id')->nullable();
          $table->integer('team2Id')->nullable();
          $table->integer('round')->nullable();
          $table->integer('gameId')->nullable();
          $table->integer('leagueId')->nullable();
          $table->boolean('reported')->default(false);
          $table->integer('team1Score')->default(0);
          $table->integer('team2Score')->default(0);
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
        Schema::drop('schedule_listings');
    }
}
