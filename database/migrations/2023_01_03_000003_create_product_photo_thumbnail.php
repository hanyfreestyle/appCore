<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_product_photo_thumbnail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();

            $table->string("key")->nullable();
            $table->string("file")->nullable();
            $table->string("width")->nullable();
            $table->string("height")->nullable();
            $table->string("url")->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_product_photo_thumbnail');
    }
};
