<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCertificationRequetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("resident_id");
            $table->foreignId("certification_id");
            $table->string('purpose');
            $table->string('time')->nullable();
            $table->string('date')->nullable();
            $table->string('expected_time')->nullable();
            $table->string('expected_date')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('certification_requets');
    }
};
