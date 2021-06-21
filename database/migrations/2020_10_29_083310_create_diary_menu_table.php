<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaryMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_menu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diary_id')->unsigned();
            $table->bigInteger('menu_id')->unsigned();
            $table->timestamps();

            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_menu');
    }
}
