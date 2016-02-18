<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdAndTroopsToPlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('players');
        
        Schema::create('players', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('game_id')->unsigned()->index();
            $table->boolean('is_host')->default(false);
            $table->integer('troops');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

            // We need user_id and game_id to be a unique combination
            $table->unique(['user_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function ($table) {
            $table->dropColumn(['id', 'troops']);
        });
    }
}
