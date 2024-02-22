<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon')->nullable();
            $table->string('photo')->nullable();
            $table->string('photo_thum_1')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
