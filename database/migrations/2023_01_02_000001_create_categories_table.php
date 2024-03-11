<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('old_id')->nullable();
            $table->integer('old_parent')->nullable();
            $table->integer('deep')->default(0);
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("icon")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->integer('product_count')->default(0);
            $table->timestamps();
        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_categories');
    }
};
