<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->morphs('commentable');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->text('comment');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
