<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicPatientInfoMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_patient_info_memos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->unsigned();
            $table->bigInteger('patient_info_id')->unsigned();
            $table->text('memo')->nullable();
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('patient_info_id')->references('id')->on('patient_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_patient_info_memos');
    }
}
