<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diary_id')->unsigned();
            $table->smallInteger('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('mtb_part_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_categories');
    }
}
