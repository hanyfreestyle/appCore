<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('data_country_translations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('country_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('continent')->nullable();
            $table->string('nationality')->nullable();

            $table->unique(['country_id','locale']);
            $table->foreign('country_id')->references('id')->on('data_countries')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_country_translations');
    }

};
