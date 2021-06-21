<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('unique_id')->nullable()->comment('ニックネーム');
            $table->string('nickname')->nullable()->comment('ニックネーム');
            $table->text('intro')->nullable()->comment('自己紹介');
            $table->string('area')->nullable()->comment('施術を考えているエリア');
            $table->string('photo')->nullable();
            $table->string('gender')->nullable()->change();
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
            $table->dropColumn(['unique_id', 'nickname', 'intro', 'area', 'photo']);
            $table->string('gender')->change();
        });
    }
}
