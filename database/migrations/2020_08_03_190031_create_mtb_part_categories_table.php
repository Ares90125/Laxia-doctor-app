<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtbPartCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtb_part_categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('parent_id')->unsigned()->nullable();
            $table->string('name')->comment('カテゴリー名');
            $table->tinyInteger('visible')->default(1);
            $table->smallInteger('sort_no')->nullable();
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
        Schema::dropIfExists('mtb_part_categories');
    }
}
