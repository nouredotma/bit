<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(4)->get();
        $categories = Category::withCount('products')->take(4)->get();
        return view('shop.home', compact('products', 'categories'));
    }

    public function about()
    {
        return view('shop.about');
    }
}
