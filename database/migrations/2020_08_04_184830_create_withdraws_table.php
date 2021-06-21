<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->unsigned()->nullable();
            $table->string('month')->comment('年・月');
            $table->integer('price')->nullable()->default(0)->comment('売上');
            $table->float('tax')->nullable()->default(10)->comment('手数料');
            $table->integer('system_fee')->nullable()->default(50000)->comment('システム利用料');
            $table->datetime('paid_at')->nullable()->comment('支払日');
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
