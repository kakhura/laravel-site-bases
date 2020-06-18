<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->boolean('published')->default(true);
                $table->unsignedSmallInteger('ordering')->nullable()->index();
                $table->string('image');

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('blog_details')) {
            Schema::create('blog_details', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('blog_id')->index();
                $table->string('title');
                $table->text('description');
                $table->string('locale')->index();

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('blog_id')->on('blogs')->references('id')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        if (!Schema::hasTable('blog_images')) {
            Schema::create('blog_images', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('blog_id')->index();
                $table->text('image');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('blog_id')->on('blogs')->references('id')->onDelete('cascade')->onUpdate('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_images');
        Schema::dropIfExists('blog_details');
        Schema::dropIfExists('blogs');
    }
}