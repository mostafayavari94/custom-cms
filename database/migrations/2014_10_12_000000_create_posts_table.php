
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('title');
            $table->string('text');
            $table->string('abstract');
            $table->string('image');
            $table->timestamp('create_date')->useCurrent = true;
            $table->integer('status');
            
        });


         Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->foreign('post_id')
            ->references('id')->on('posts')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('name');
            $table->string('text');
            $table->string('email');
            $table->timestamp('create_date')->useCurrent = true;
            $table->integer('status');
            $table->integer('reply_for');
            $table->integer('notify_status');
            
        });

        Schema::create('post_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->string('link');            
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->references('id')->on('posts')->onDelete('cascade');       
            $table->unsignedInteger('category_id')->references('id')->on('categories')->onDelete('cascade');                
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('status');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
