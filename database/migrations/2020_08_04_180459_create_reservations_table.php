<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date')->nullable()->comment('来院日時');
            $table->time('start_time')->nullable()->comment('診察時間');
            $table->time('end_time')->nullable()->comment('診察時間');
            $table->bigInteger('clinic_id')->unsigned()->nullable();
            $table->bigInteger('patient_info_id')->unsigned()->nullable();
            $table->bigInteger('stuff_id')->unsigned()->nullable();
            $table->bigInteger('rsv_content_id')->unsigned()->nullable()->comment('予約内容');
            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->string('status')->nullable()->comment('ステータス');
            $table->string('source')->nullable()->comment('予約方法');
            $table->string('hope_treat')->nullable()->comment('当日は施術を希望されますか？');
            $table->string('is_visited')->nullable()->comment('過去に湘南美容クリニックに来院経験ありますか？');
            $table->string('note')->nullable()->comment('ご要望や、ご質問があればどうぞ');
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('patient_info_id')->references('id')->on('patient_infos')->onDelete('cascade');
            $table->foreign('rsv_content_id')->references('id')->on('mtb_rsv_contents')->onDelete('set null');
            $table->foreign('stuff_id')->references('id')->on('stuffs')->onDelete('set null');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
