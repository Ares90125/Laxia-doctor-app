<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtbDiaryRateQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtb_diary_rate_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['TREAT', 'CLINIC', 'DOCTOR']);
            $table->tinyInteger('visible')->default(1);
            $table->tinyInteger('sort_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtb_diary_rate_questions');
    }
}
