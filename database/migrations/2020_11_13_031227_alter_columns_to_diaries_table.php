<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsToDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->integer('cost_anesthetic')->nullable()->comment('麻酔費用');
            $table->integer('cost_drug')->nullable()->comment('処方薬の費用');
            $table->integer('cost_other')->nullable()->comment('その他の費用');
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
                'cost_anesthetic',
                'cost_drug',
                'cost_other',
            ]);
        });
    }
}
