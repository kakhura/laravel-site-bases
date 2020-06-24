<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->boolean('published')->default(true);
                $table->unsignedSmallInteger('ordering')->nullable()->index();
                $table->string('image');
                $table->string('thumb')->nullable();

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('news_details')) {
            Schema::create('news_details', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('news_id')->index();
                $table->string('title');
                $table->text('description');
                $table->string('locale')->index();

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('news_id')->on('news')->references('id')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        if (!Schema::hasTable('news_images')) {
            Schema::create('news_images', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('news_id')->index();
                $table->string('image');
                $table->string('thumb');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('news_id')->on('news')->references('id')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        Artisan::call('ui', [
            'type' => 'bootstrap',
            '--auth' => true,
        ]);

        Artisan::call('vendor:publish', [
            '--provider' => 'Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_images');
        Schema::dropIfExists('news_details');
        Schema::dropIfExists('news');
    }
}
