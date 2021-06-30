<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtbCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtb_cities', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->tinyInteger('pref_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('pref_id')->references('id')->on('mtb_prefs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtb_cities');
    }
}
