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
            $table->string('post_name');
            $table->string('post_slug')->nullable();
            $table->enum('status', ['used', 'new']);
            $table->string('price');
            $table->text('post_description')->nullable();
            $table->integer('location_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->string('feature_image')->nullable();
            $table->integer('image_id')->nullable()->unsigned();

            $table->foreign('location_id')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
            $table->foreign('image_id')
                  ->references('id')->on('images')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
