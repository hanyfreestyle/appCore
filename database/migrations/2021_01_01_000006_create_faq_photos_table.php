<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('faq_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('faq_id')->unsigned();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->string("photo_thum_2")->nullable();
            $table->integer("position")->default(0);
            $table->integer("print_photo")->default(2);
            $table->integer("is_default")->default(0);
            $table->foreign('faq_id')->references('id')->on('faq_faqs')->onDelete('cascade');
        });

        Schema::create('faq_photo_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('photo_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('des')->nullable();
            $table->unique(['photo_id', 'locale']);
            $table->foreign('photo_id')->references('id')->on('faq_photos')->onDelete('cascade');;
        });

    }


    public function down(): void {
        Schema::dropIfExists('faq_photo_translations');
        Schema::dropIfExists('faq_photos');
    }
};
