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
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void {
        Schema::dropIfExists('blog_post');
    }
};
