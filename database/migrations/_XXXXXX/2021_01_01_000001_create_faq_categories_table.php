<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('deep')->default(0);
            $table->string("icon")->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->timestamps();
        });

        Schema::create('faq_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name')->nullable();
            $table->text('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['category_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('category_id')->references('id')->on('faq_categories')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('faq_category_translations');
        Schema::dropIfExists('faq_categories');
    }
};
