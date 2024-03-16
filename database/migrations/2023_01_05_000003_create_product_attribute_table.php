<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_product_attribute', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('attribute_id')->unsigned();
            $table->json('values')->nullable();
            $table->primary(['product_id','attribute_id']);
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('pro_attributes')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('pro_product_attribute');

    }
};
