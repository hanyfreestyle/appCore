<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_category_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('category_id');
            $table->unsignedBiginteger('product_id');

            $table->foreign('category_id')->references('id')
                ->on('pro_categories')->onDelete('cascade');

            $table->foreign('product_id')->references('id')
                ->on('pro_products')->onDelete('cascade');

        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_category_product');
    }

};
