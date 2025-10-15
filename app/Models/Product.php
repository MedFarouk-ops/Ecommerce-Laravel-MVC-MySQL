<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Include 'stock' and photo fields in fillable
    protected $fillable = [
        'name',
        'description',
        'price',
        'base_price',
        'category_id',
        'stock',
        'photo1',
        'photo2'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Optional: Accessors for full URLs
    public function getPhoto1UrlAttribute() {
        return $this->photo1 ? asset('storage/' . $this->photo1) : null;
    }

    public function getPhoto2UrlAttribute() {
        return $this->photo2 ? asset('storage/' . $this->photo2) : null;
    }
}
