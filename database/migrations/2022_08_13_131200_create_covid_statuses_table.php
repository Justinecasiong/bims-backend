<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCovidStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("resident_id");
            $table->string("vaccination_type");
            $table->integer("dose_num");
            $table->string("booster_type");
            $table->string("reason");
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
        Schema::dropIfExists('covid_statuses');
    }
};
