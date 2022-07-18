<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('manufacturer');
            $table->integer('cost_in_credits');
            $table->integer('length');
            $table->integer('max_atmosphering_speed');
            $table->string('crew');
            $table->integer('passengers');
            $table->integer('cargo_capacity');
            $table->string('hyperdrive_rating');
            $table->integer('MGLT');
            $table->string('starship_class');
            $table->integer('external_id');
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
        Schema::dropIfExists('starships');
    }
}
