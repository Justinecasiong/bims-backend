<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBarangayOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_officials', function (Blueprint $table) {
            $table->id();
            $table->foreignId("chairmanship_id");
            $table->foreignId("position_id");
            $table->string("fullname");
            $table->string("term_start");
            $table->string("term_end");
            $table->string("status");
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
        Schema::dropIfExists('barangay_officials');
    }
};
