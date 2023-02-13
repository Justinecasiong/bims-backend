<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBarangayInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_information', function (Blueprint $table) {
            $table->id();
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('contact_num');
            $table->string('description');
            $table->string('municipality_logo');
            $table->string('barangay_logo');
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
        Schema::dropIfExists('barangay_information');
    }
};
