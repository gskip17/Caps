<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LookingFor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LF_Post', function(Blueprint $table){
                    $table->increments('id')->index();
                    $table->string('players');
                    $table->integer('posterId');
                    $table->string('date');
                    $table->boolean('status'); // True for available, false for playing/done.
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
        Schema::drop('LF_Post');
    }
}
