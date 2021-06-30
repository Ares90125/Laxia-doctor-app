<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaryRateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_rate_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('diary_id')->unsigned();
            $table->float('rate')->nullable();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('mtb_diary_rate_questions')->onDelete('cascade');
            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_rate_questions');
    }
}
