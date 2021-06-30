<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStuffIdColumnToCounselingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counseling_reports', function (Blueprint $table) {
            $table->bigInteger('stuff_id')->unsigned()->nullable();
            $table->foreign('stuff_id')->references('id')->on('stuffs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counseling_reports', function (Blueprint $table) {
            $table->dropForeign('counseling_reports_stuff_id_foreign');
            $table->dropColumn('stuff_id');
        });
    }
}
