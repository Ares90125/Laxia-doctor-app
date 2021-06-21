<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostColumnToDiaryMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diary_menu', function (Blueprint $table) {
            $table->integer('cost')->nullable()->comment('施術費用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diary_menu', function (Blueprint $table) {
            $table->dropColumn('cost');
        });
    }
}
