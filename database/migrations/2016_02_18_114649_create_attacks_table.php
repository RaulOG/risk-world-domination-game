<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attacks', function($table){
            $table->increments('id');
            $table->integer('attacker_id')->unsigned()->index();
            $table->integer('defender_id')->unsigned()->index();
            $table->integer('turn_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('attacker_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('defender_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('turn_id')->references('id')->on('turns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attacks');
    }
}
