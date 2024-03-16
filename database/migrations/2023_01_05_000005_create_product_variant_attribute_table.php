<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_product_variant_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('variant_id')->unsigned();
            $table->bigInteger('attribute_id')->unsigned();
            $table->bigInteger('value_id')->unsigned();

            $table->foreign('variant_id')->references('id')->on('pro_product_variants')->onDelete('cascade');
//            $table->foreign('attribute_id')->references('id')->on('pro_attributes')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_product_variant_attribute');

    }
};
