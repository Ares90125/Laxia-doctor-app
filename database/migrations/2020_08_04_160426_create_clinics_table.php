<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable()->comment('クリニック名');
            $table->tinyInteger('pref_id')->unsigned()->nullable()->comment('都道府県');
            $table->string('address')->nullable()->comment('住所');
            $table->string('net_reservation')->nullable()->comment('ネット予約');
            $table->string('nearest_station')->nullable()->comment('最寄駅');
            $table->string('site')->nullable()->comment('公式サイト');
            $table->string('access')->nullable()->comment('アクセス');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->string('working_time')->nullable()->comment('営業時間');
            $table->string('credit_card')->nullable()->comment('クレジットカード');
            $table->string('holidays')->nullable()->comment('休業日');
            $table->string('parking')->nullable()->comment('駐車場');
            $table->string('company_title')->nullable()->comment('タイトル（会社紹介）');
            $table->string('company_profile')->nullable()->comment('会社紹介文（会社紹介）');
            $table->string('photo')->nullable()->comment('写真');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pref_id')->references('id')->on('mtb_prefs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
