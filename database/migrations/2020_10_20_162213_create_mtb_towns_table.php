<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtbTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtb_towns', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->smallInteger('city_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('mtb_cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtb_towns');
    }
}
