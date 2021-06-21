<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->unsigned()->comment('');
            $table->bigInteger('menu_id')->unsigned()->nullable()->comment('メニュー名');
            $table->bigInteger('speciality_id')->unsigned()->nullable()->comment('カテゴリー');
            $table->bigInteger('stuff_id')->unsigned()->nullable()->comment('担当医師');
            $table->tinyInteger('patient_age')->nullable()->comment('施術者の年齢');
            $table->string('patient_gender')->nullable()->comment('施術者の性別');
            $table->text('case_description')->nullable()->comment('症例の解説');
            $table->text('treat_risk')->nullable()->comment('副作用・リスク');
            $table->string('before_photo')->nullable()->comment('beforeの写真');
            $table->string('after_photo')->nullable()->comment('afterの写真');
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('set null');
            $table->foreign('speciality_id')->references('id')->on('mtb_specialities')->onDelete('set null');
            $table->foreign('stuff_id')->references('id')->on('stuffs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
