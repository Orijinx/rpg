<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string("name")->default("Ivan");
            $table->string("race");
            $table->string("role")->default("warrior");
            $table->integer("mind");
            $table->integer("strength");
            $table->integer("agility");
            $table->unsignedBigInteger("room_id")->nullable();
            $table->foreign("room_id")->references("id")->on("rooms");
            // $table->foreign("room_key")
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
        Schema::dropIfExists('characters');
    }
}
