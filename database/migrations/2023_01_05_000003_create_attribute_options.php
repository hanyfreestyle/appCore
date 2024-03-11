<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_attribute_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attribute_id')->unsigned();
            $table->integer('old_id')->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
            $table->foreign('attribute_id')->references('id')->on('pro_attributes')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_attribute_options');
    }
};
