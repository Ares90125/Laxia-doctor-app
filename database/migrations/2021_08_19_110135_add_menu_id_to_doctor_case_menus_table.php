<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenuIdToDoctorCaseMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_case_menus', function (Blueprint $table) {
            $table->bigInteger('menu_id')->after('case_id')->nullable()->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_case_menus', function (Blueprint $table) {
            $table->dropForeign('doctor_case_menus_menu_id_foreign');
            $table->dropColumn('menu_id');
        });
    }
}
