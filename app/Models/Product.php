<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Include 'stock' in fillable
    protected $fillable = ['name', 'description', 'price', 'category_id', 'stock'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
