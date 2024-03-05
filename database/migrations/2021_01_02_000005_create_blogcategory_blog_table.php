<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('blogcategory_blog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('category_id');
            $table->unsignedBiginteger('blog_id');
            $table->integer('postion')->default(0);

            $table->foreign('category_id')->references('id')
                ->on('blog_categories')->onDelete('cascade');

            $table->foreign('blog_id')->references('id')
                ->on('blog_post')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('blogcategory_blog');
    }

};
