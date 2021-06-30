<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('counseling_id')->unsigned();
            $table->smallInteger('category_id')->unsigned();
            
            $table->foreign('counseling_id')->references('id')->on('counseling_reports')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('mtb_interest_categories')->onDelete('cascade');
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
        Schema::dropIfExists('counseling_categories');
    }
}
