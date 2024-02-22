<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('config_news_letters', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->integer('export')->nullable();
            $table->dateTime('created_at');
//            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('config_news_letters');
    }
};
