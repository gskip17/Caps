<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeamsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams',function(Blueprint $table){
          $table->increments('id')->index();
          $table->string('teamName');
          $table->integer('member1Id')->nullable();
          $table->integer('member2Id')->nullable();
          $table->integer('leagueId')->nullable();
          $table->integer('wins')->default(0);
          $table->integer('losses')->default(0);
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
        Schema::drop('teams');
    }
}
