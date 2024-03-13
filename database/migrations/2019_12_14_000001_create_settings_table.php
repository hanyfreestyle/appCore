<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('config_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('web_url')->nullable();
            $table->integer('web_status')->default('1');
            $table->integer('fav_view')->default('1');


            $table->string('phone_num')->nullable();
            $table->string('whatsapp_num')->nullable();
            $table->string('phone_call')->nullable();
            $table->string('whatsapp_send')->nullable();
            $table->string('email')->nullable();

            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('google_api')->nullable();

            $table->dateTime('project_update')->nullable();
            $table->dateTime('location_update')->nullable();
            $table->dateTime('developer_update')->nullable();
        });


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


    public function down(): void {
        Schema::dropIfExists('config_setting_translations');
        Schema::dropIfExists('config_settings');
    }
};
