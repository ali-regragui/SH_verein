<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('roomId');
            $table->unsignedBigInteger('ideaId');
            $table->unsignedBigInteger('toUser');
            $table->unsignedBigInteger('fromUser');
            $table->string('body')->nullable();
            $table->foreign('ideaId')->references('id')->on('ideas');
            $table->foreign('fromUser')->references('id')->on('users');
            $table->foreign('toUser')->references('id')->on('users');
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
        Schema::dropIfExists('chats');
    }
}
