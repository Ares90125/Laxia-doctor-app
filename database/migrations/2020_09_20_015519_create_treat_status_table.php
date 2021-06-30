<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treat_status', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('progress_id')->unsigned()->nullable();
            $table->tinyInteger('indicator_id')->unsigned()->nullable();
            $table->tinyInteger('value')->nullable();

            $table->foreign('progress_id')->references('id')->on('treat_progresses')->onDelete('cascade');
            $table->foreign('indicator_id')->references('id')->on('mtb_treat_indicators')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treat_status');
    }
}
