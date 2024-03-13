<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('blog_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('blog_id')->unsigned();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();
            $table->integer("position")->default(0);
            $table->integer("print_photo")->default(2);
            $table->integer("is_default")->default(0);
            $table->foreign('blog_id')->references('id')->on('blog_post')->onDelete('cascade');
        });

        Schema::create('blog_photo_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('photo_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('des')->nullable();
            $table->unique(['photo_id', 'locale']);
            $table->foreign('photo_id')->references('id')->on('blog_photos')->onDelete('cascade');;
        });

    }


    public function down(): void {
        Schema::dropIfExists('blog_photo_translations');
        Schema::dropIfExists('blog_photos');
    }
};
