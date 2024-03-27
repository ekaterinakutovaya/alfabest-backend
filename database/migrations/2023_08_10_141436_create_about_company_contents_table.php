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
        Schema::create('about_company_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('home_page_image', 255);
            $table->string('about_company_page_image', 255);
            $table->string('home_page_text', 255);
            $table->string('about_company_page_text', 255);
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
        Schema::dropIfExists('about_company_contents');
    }
};
