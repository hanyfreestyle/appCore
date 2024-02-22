<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('restrict');
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('restrict');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('restrict');
        });
    }


    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['developer_id']);
            $table->dropForeign(['listing_id']);
            $table->dropForeign(['location_id']);
        });
    }

};
