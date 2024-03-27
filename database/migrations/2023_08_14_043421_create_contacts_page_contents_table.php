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
        Schema::create('contacts_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title', 2048);
            $table->longText('text');
            $table->string('address', 2048);
            $table->string('email', 255);
            $table->string('image', 2048);
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
        Schema::dropIfExists('contacts_page_contents');
    }
};
