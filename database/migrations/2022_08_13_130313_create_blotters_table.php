<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBlottersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();
            $table->string('complainant');
            $table->string('respondent');
            $table->string('victims');
            $table->string('type');
            $table->string('location');
            $table->string('date');
            $table->string('time');
            $table->string('blotter_status');
            $table->string('details');
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
        Schema::dropIfExists('blotters');
    }
};
