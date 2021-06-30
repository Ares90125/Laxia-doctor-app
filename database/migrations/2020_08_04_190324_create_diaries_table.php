<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->unsigned()->comment('患者ID');
            $table->bigInteger('clinic_id')->unsigned()->comment('クリニックID');
            $table->date('treat_date')->nullable()->comment('施術を受けた日');
            $table->bigInteger('doctor_id')->unsigned()->comment('担当ドクターID');
            $table->integer('price')->nullable()->comment('施術費用');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('stuffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
}
