<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentarioRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentario_replies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("commentario_id")->/*default('15')->*/unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->text('commentario');

            $table->timestamps();

            // Delete all comments on commentarios posts
            $table->foreign('commentario_id')->references('id')->on('commentarios')->onDelete('cascade');
            // Delete all comments on delete users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');/**/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentario_replies');
    }
}
