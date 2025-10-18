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
        Schema::table('website_infos', function (Blueprint $table) {
            // Extra info sections
            $table->text('shipping_info')->nullable();
            $table->text('secure_payment_info')->nullable();
            $table->text('easy_returns_info')->nullable();

            // Pages sections
            $table->string('about_us_title')->nullable();
            $table->longText('about_us_description')->nullable();
            $table->string('contact_title')->nullable();
            $table->longText('contact_description')->nullable();
            $table->string('faq_title')->nullable();
            $table->longText('faq_description')->nullable();
            $table->string('privacy_policy_title')->nullable();
            $table->longText('privacy_policy_description')->nullable();
            $table->string('terms_service_title')->nullable();
            $table->longText('terms_service_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_infos', function (Blueprint $table) {
            //
        });
    }
};
