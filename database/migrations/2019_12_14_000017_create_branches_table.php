<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void
    {
        Schema::create('config_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('whatsapp')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('direction')->nullable();

            $table->integer('is_active')->default(1);
            $table->integer('postion')->default(0);
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('config_branches');
    }
};
