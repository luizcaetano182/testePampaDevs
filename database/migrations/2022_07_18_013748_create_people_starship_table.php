<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleStarshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_starship', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('person_id')
            ->foreign('people_id')->references('id')->on('people');
            $table->unsignedInteger('starship_id')
            ->foreign('starship_id')->references('id')->on('starship');
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
        Schema::dropIfExists('person_starship');
    }
}
