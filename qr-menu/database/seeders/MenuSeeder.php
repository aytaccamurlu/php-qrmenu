<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $cat1 = Category::create(['name' => 'Burgerler', 'order' => 1]);
        $cat1->products()->create([
            'name' => 'Klasik Burger',
            'description' => 'Dana köfte, marul, domates',
            'price' => 250,
            'is_active' => true
        ]);

        $cat2 = Category::create(['name' => 'İçecekler', 'order' => 2]);
        $cat2->products()->create([
            'name' => 'Soğuk Çay',
            'description' => 'Şeftali aromalı',
            'price' => 60,
            'is_active' => true
        ]);
    }
}