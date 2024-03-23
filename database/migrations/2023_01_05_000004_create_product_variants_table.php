<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_product_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('variants_slug');
            $table->string('variants_slug_id')->nullable();
            $table->string('variants_string');

            $table->integer('sku')->nullable()->default(null);

            $table->float('price')->nullable()->default(null);
            $table->float('regular_price')->nullable()->default(null);

            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');

        });

    }


    public function down(): void {
        Schema::dropIfExists('pro_product_variants');
    }
};
