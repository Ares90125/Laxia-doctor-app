<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->nullable()->unsigned();
            $table->string('name')->nullable()->comment('メニュー名');
            $table->smallInteger('category_id')->unsigned()->nullable()->comment('カテゴリー');
            $table->integer('price')->nullable()->comment('料金');
            $table->text('description')->nullable()->comment('メニューの説明');
            $table->text('risk')->nullable()->comment('副作用・リスク');
            $table->text('guarantee')->nullable()->comment('施術の保証');
            $table->tinyInteger('treat_time')->nullable()->comment('施術の時間');
            $table->tinyInteger('basshi')->nullable()->comment('抜糸');
            $table->tinyInteger('hospital_visit')->nullable()->comment('施術後の通院');
            $table->tinyInteger('hare')->nullable()->comment('腫れ');
            $table->tinyInteger('pain')->nullable()->comment('痛み');
            $table->tinyInteger('bleeding')->nullable()->comment('内出血');
            $table->tinyInteger('hospital_need')->nullable()->comment('入院の必要性');
            $table->tinyInteger('masui')->nullable()->comment('麻酔');
            $table->tinyInteger('makeup')->nullable()->comment('メイク/洗顔');
            $table->tinyInteger('shower')->nullable()->comment('シャワー/洗髪/入浴');
            $table->tinyInteger('massage')->nullable()->comment('施術部のマッサージ');
            $table->tinyInteger('sport_impossible')->nullable()->comment('激しいスポーツ');
            $table->string('photo')->nullable()->comment('画像');
            $table->tinyInteger('status')->default(1)->comment('掲載ステータ');
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('mtb_part_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
