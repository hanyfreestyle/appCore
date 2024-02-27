<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();

            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();

            $table->unique(['category_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('category_id')->references('id')->on('pro_categories')->onDelete('cascade');

        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_category_translations');
    }
};
