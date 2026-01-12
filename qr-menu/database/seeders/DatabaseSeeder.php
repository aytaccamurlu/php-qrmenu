<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void {
    $cat = \App\Models\Category::create(['name' => 'Ana Yemekler']);
    $cat->products()->create([
        'name' => 'Özel Burger',
        'description' => '180gr dana köfte, karamelize soğan',
        'price' => 250.00,
        'is_active' => true
    ]);
    
    $cat2 = \App\Models\Category::create(['name' => 'İçecekler']);
    $cat2->products()->create([
        'name' => 'Ev Yapımı Limonata',
        'description' => 'Taze nane ile',
        'price' => 85.00,
        'is_active' => true
    ]);
}
}
