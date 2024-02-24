<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void
    {
        Schema::create('config_app_setting_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('setting_id')->unsigned();
            $table->string('locale')->index();

            $table->string('AppName')->nullable();
            $table->string('whatsAppMessage')->nullable();

            $table->unique(['setting_id','locale']);
            $table->foreign('setting_id')->references('id')->on('config_app_settings')->onDelete('cascade');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('config_app_setting_translations');
    }
};
