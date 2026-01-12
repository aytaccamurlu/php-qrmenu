<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Bu satır, hangi alanların doldurulabileceğini Laravel'e söyler
    protected $fillable = ['name', 'order'];

    public function products() {
        return $this->hasMany(Product::class);
    }
}