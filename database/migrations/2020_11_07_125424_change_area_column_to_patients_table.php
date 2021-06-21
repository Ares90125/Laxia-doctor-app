<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAreaColumnToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('area');
            $table->tinyInteger('area_id')->unsigned()->nullable()->comment('施術を考えているエリア');
            $table->foreign('area_id')->references('id')->on('mtb_prefs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign('patients_area_id_foreign');
            $table->dropColumn(['area_id']);
            $table->string('area')->nullable()->comment('施術を考えているエリア');

        });
    }
}
