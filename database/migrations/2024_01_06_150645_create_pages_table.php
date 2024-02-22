<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('links')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('compound_id')->nullable();
            $table->json('property_type')->nullable();
            $table->json('slug')->nullable();
            $table->text('hash')->nullable();
            $table->integer('is_active')->default(1);

            $table->timestamps();
            $table->softDeletes();


            $table->foreign('compound_id')->references('id')->on('listings')->onDelete('restrict');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('restrict');


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
