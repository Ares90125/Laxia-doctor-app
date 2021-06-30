<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->unsigned()->nullable()->comment('患者ID');
            $table->bigInteger('clinic_id')->unsigned()->nullable()->comment('クリニックID');
            $table->date('counseling_date')->nullable()->comment('');
            $table->text('content')->nullable();
            $table->text('reason')->nullable();
            $table->text('before_counseling')->nullable();
            $table->text('after_ccounseling')->nullable();
            $table->integer('rate')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counseling_reports');
    }
}
