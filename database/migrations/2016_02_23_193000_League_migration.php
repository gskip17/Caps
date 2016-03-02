<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeagueMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues',function(Blueprint $table){
            $table->increments('id')->index();
            $table->string('name');
            $table->timestamps();
            $table->string('organization')->nullable();
            $table->integer('userId')->nullable();
            $table->integer('gamesplayed');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leagues');
    }
}
