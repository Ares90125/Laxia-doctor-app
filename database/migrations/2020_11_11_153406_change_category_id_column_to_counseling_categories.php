<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCategoryIdColumnToCounselingCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counseling_categories', function (Blueprint $table) {
            $table->dropForeign('counseling_categories_category_id_foreign');
            $table->smallInteger('category_id')->unsigned()->nullable()->change();
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
        Schema::table('counseling_categories', function (Blueprint $table) {
            $table->dropForeign('counseling_categories_category_id_foreign');
            $table->foreign('category_id')->references('id')->on('mtb_interest_categories')->onDelete('cascade');
        });
    }
}
