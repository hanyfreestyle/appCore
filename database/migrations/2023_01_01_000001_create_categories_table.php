<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("icon")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('pro_categories')->onDelete('RESTRICT');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_categories');
    }
};