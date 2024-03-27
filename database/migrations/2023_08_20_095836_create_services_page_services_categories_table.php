<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_page_services_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->foreignId('services_page_id')->references('id')->on('services_pages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_page_services_category');
    }
};
