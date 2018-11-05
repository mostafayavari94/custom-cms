
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
            $table->integer('user_id');
            $table->string('title');
            $table->string('text');
            $table->string('abstract');
            $table->string('image');
            $table->timestamp('create_date')->useCurrent = true;
            $table->integer('status');
            
        });

         Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
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
            $table->integer('post_id');
            $table->string('link');            
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->string('category_id');
            
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name');
            $table->string('description');
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
