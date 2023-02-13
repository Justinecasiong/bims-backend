<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddIdentifacationInResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn('national_id');
            $table->dropColumn('citizenship');
            $table->string('identifation')->nullable();
            $table->string('identification_img')->nullable();
            $table->string('educational_status');
            $table->string('yearly_income')->nullable();
            $table->string('pregnant');
            $table->string('due_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residents', function (Blueprint $table) {
            //
        });
    }
};
