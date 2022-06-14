<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("post_id")->/*default('15')->*/unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->text('commentario');

            $table->timestamps();

            // Delete all comments on delete posts
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('commentarios');
    }
}