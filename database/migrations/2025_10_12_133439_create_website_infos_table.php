<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('website_infos', function (Blueprint $table) {
            $table->id();

            // About / Logo Section
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->text('about_description')->nullable();

            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();

            // Contact Section
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            // Social Links
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_infos');
    }
};
