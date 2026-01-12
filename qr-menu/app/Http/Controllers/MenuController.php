<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Kategorileri ürünleriyle birlikte çekiyoruz
        $categories = Category::with(['products' => function($query) {
            $query->where('is_active', true);
        }])->orderBy('order')->get();

        return view('menu', compact('categories'));
    }
}