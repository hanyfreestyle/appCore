<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pro_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->default(1);
            $table->integer('old_id')->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer('postion')->default(0);
        });
    }


    public function down(): void {
        Schema::dropIfExists('pro_attributes');
    }
};
