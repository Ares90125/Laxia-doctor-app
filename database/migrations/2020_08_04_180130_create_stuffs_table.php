<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stuffs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->unsigned();
            $table->string('name')->comment('氏名(漢字)');
            $table->string('kana')->comment('シメイ(カタカナ)');
            $table->string('duty')->comment('役職');
            $table->tinyInteger('job_id')->unsigned()->nullable()->comment('職種');
            $table->tinyInteger('experience_year')->comment('医師歴');
            $table->text('career')->nullable()->comment('資格');
            $table->text('profile')->nullable()->comment('経歴');
            $table->string('photo')->nullable()->comment('写真');
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('mtb_jobs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stuffs');
    }
}
