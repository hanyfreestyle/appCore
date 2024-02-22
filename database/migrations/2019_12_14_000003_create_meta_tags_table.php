<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('config_meta_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_id')->unique()->index();
            $table->string('photo')->nullable();
            $table->string('photo_thum_1')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('config_meta_tags');
    }
};
