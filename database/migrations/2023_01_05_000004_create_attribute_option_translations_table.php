<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_attribute_option_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('option_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->integer('count')->nullable();
            $table->unique(['option_id', 'locale']);
//            $table->unique(['locale', 'slug']);
            $table->foreign('option_id')->references('id')->on('pro_attribute_options')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('pro_attribute_option_translations');
    }
};
