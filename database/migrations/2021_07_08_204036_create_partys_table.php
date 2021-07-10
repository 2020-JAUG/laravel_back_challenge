<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->unique();
            $table->foreignId('game_id')->references('id')->on('games')->onDelete('cascade');
            // $table->foreignId('party_user_id')->references('id')->on('party_users')->onDelete('cascade');
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
        Schema::dropIfExists('partys');
    }
}
