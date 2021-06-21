<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mailbox_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('message')->comment('メッセージ');
            $table->tinyInteger('is_file')->default(0)->comment('メッセージタイプ');
            // 0: テキスト、1: ファイル
            $table->timestamps();

            $table->foreign('mailbox_id')->references('id')->on('mailboxes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
