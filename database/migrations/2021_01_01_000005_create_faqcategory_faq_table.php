<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('faqcategory_faq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('category_id');
            $table->unsignedBiginteger('faq_id');
            $table->integer('postion')->default(0);

            $table->foreign('category_id')->references('id')
                ->on('faq_categories')->onDelete('cascade');

            $table->foreign('faq_id')->references('id')
                ->on('faq_faqs')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('faqcategory_faq');
    }

};
