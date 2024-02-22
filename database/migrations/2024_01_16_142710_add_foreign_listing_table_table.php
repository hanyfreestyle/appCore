<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('restrict');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('restrict');
        });
    }


    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['developer_id']);
            $table->dropForeign(['location_id']);
        });
    }
};
