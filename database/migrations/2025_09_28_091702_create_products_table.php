<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // matches $fillable['name']
            $table->text('description')->nullable(); // matches $fillable['description']
            $table->decimal('price', 10, 2);         // matches $fillable['price']
            $table->integer('stock')->default(0);    // new stock column, default 0
            $table->foreignId('category_id')         // matches $fillable['category_id']
                  ->constrained('categories')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
