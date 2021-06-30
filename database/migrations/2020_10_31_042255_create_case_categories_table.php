<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_categories', function (Blueprint $table) {
            $table->bigInteger('case_id')->unsigned();
            $table->smallInteger('category_id')->unsigned();

            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
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
        Schema::dropIfExists('case_categories');
    }
}
