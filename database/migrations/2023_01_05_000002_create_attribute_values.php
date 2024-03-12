<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attribute_id')->unsigned();
            $table->integer('old_id')->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->foreign('attribute_id')->references('id')->on('pro_attributes')->onDelete('cascade');
        });

        Schema::create('pro_attribute_value_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('value_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->integer('count')->nullable();
            $table->unique(['value_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('value_id')->references('id')->on('pro_attribute_values')->onDelete('cascade');
        });
        
    }


    public function down(): void {
        Schema::dropIfExists('pro_attribute_value_translations');
        Schema::dropIfExists('pro_attribute_values');
    }
};
