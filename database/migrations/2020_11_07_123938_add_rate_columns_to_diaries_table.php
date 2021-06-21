<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRateColumnsToDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->tinyInteger('rate_01')->nullable();
            $table->tinyInteger('rate_02')->nullable();
            $table->tinyInteger('rate_03')->nullable();
            $table->tinyInteger('rate_04')->nullable();
            $table->tinyInteger('rate_05')->nullable();
            $table->tinyInteger('rate_06')->nullable();
            $table->tinyInteger('rate_07')->nullable();
            $table->tinyInteger('rate_08')->nullable();
            $table->tinyInteger('rate_09')->nullable();
            $table->float('ave_rate', 2, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->dropColumn([
                'rate_01',
                'rate_02',
                'rate_03',
                'rate_04',
                'rate_05',
                'rate_06',
                'rate_07',
                'rate_08',
                'rate_09',
                'ave_rate',
            ]);
        });
    }
}
