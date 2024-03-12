<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('old_id')->nullable();


            $table->integer('brand_id')->nullable()->default(null);
            $table->integer('old_brand_id')->nullable()->default(null);
            $table->integer('sku')->nullable()->default(null);

            $table->integer('cat_id')->nullable()->default(null);
            $table->integer('old_cat_id')->nullable()->default(null);
            $table->integer('children')->nullable()->default(null);
            $table->integer('type')->nullable()->default(1);
            $table->text('tag_id')->nullable()->default(null);

            $table->float('price')->nullable()->default(null);
            $table->float('regular_price')->nullable()->default(null);
            $table->float('sale_price')->nullable()->default(null);
            $table->integer('qty_left')->nullable()->default(null);
            $table->integer('qty_max')->nullable()->default(null);
            $table->string("unit")->nullable();

            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();
            $table->string("photo_thum_3")->nullable();

            $table->boolean("on_stock")->default(true);
            $table->boolean("is_active")->default(true);
            $table->boolean("is_archived")->default(false);

            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('pro_product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->longText('short_des')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['product_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('pro_product_translations');
        Schema::dropIfExists('pro_products');
    }
};
