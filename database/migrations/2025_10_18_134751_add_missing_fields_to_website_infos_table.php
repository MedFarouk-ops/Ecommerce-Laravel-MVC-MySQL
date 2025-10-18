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
        if (!Schema::hasColumn('website_infos', 'shipping_info')) {
            $table->text('shipping_info')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'secure_payment_info')) {
            $table->text('secure_payment_info')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'easy_returns_info')) {
            $table->text('easy_returns_info')->nullable();
        }

        if (!Schema::hasColumn('website_infos', 'contact_title')) {
            $table->string('contact_title')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'contact_description')) {
            $table->text('contact_description')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'faq_title')) {
            $table->string('faq_title')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'faq_description')) {
            $table->text('faq_description')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'privacy_policy_title')) {
            $table->string('privacy_policy_title')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'privacy_policy_description')) {
            $table->text('privacy_policy_description')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'terms_service_title')) {
            $table->string('terms_service_title')->nullable();
        }
        if (!Schema::hasColumn('website_infos', 'terms_service_description')) {
            $table->text('terms_service_description')->nullable();
        }
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
