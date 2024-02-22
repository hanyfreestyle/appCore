<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('config_setting_translations', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('setting_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('closed_mass')->nullable();
            $table->unique(['setting_id','locale']);
            $table->foreign('setting_id')->references('id')->on('config_settings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('config_setting_translations');
    }
};
