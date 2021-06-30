<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuffSpecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stuff_specialities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stuff_id')->unsigned();
            $table->bigInteger('speciality_id')->unsigned();
            $table->timestamps();

            $table->foreign('stuff_id')->references('id')->on('stuffs')->onDelete('cascade');
            $table->foreign('speciality_id')->references('id')->on('mtb_specialities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stuff_specialities');
    }
}
