<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('blog_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("is_active")->nullable()->default(true);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->integer('url_type')->nullable()->default(0);
            $table->string('youtube')->nullable();
            $table->date('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('blog_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('blog_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();

            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->string('youtube_title')->nullable();

            $table->unique(['blog_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('blog_id')->references('id')->on('blog_post')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('blog_translations');
        Schema::dropIfExists('blog_post');
    }
};
