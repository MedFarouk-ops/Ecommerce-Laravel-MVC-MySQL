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
            $table->string('currency', 10)
                  ->nullable()
                  ->charset('utf8mb4')
                  ->collation('utf8mb4_unicode_ci')
                  ->after('terms_service_description'); // add after last field
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
