<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('config_contact_us_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('export')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('full_number')->nullable();
            $table->string('country')->nullable();
            $table->string('subject')->nullable();
            $table->integer('listing_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('request_type')->default(1);
            $table->dateTime('meeting_day')->nullable();
            $table->string('meeting_time')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('config_contact_us_forms');
    }

};
