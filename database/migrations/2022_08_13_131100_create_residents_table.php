<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId("zone_id");
            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("last_name");
            $table->string("alias")->nullable();
            $table->string("place_of_birth");
            $table->integer("age");
            $table->string("civil_status");
            $table->string("birthdate");
            $table->string("sex");
            $table->string("voter_status");
            $table->string("identified_as");
            $table->string("email")->nullable();
            $table->string("contact_num");
            $table->string("occupation")->nullable();
            $table->string("pwd_status");
            $table->string("address");
            $table->string("profile_pic")->nullable();
            $table->string("national_id")->nullable();
            $table->string("citizenship")->nullable();
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
        Schema::dropIfExists('residents');
    }
};
