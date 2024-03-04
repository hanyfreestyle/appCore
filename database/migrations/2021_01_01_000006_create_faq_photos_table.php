<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('faq_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('faq_id')->unsigned();

            $table->longText("des_en")->nullable();
            $table->longText("des_es")->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();
            $table->string("file_extension")->nullable();

            $table->integer("file_size")->nullable();
            $table->integer("file_h")->nullable();
            $table->integer("file_w")->nullable();
            $table->integer("position")->default(0);
            $table->integer("print_photo")->default(2);
            $table->integer("is_default")->default(0);

            $table->timestamps();
            $table->foreign('faq_id')->references('id')->on('faq_faqs')->onDelete('cascade');

        });
    }


    public function down(): void {
        Schema::dropIfExists('faq_photos');
    }
};
