<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        Admin::updateOrCreate(
            ['username' => 'admin'],
            ['password' => Hash::make('password')]
        );

        // Categories
        $categories = [
            ['name' => 'Hats', 'slug' => 'hats'],
            ['name' => 'T-Shirts', 'slug' => 't-shirts'],
            ['name' => 'Hoodies', 'slug' => 'hoodies'],
            ['name' => 'Pants', 'slug' => 'pants'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Products
        $productData = [
            ['name' => 'Classic Black Hat', 'category_id' => 1, 'price' => 24.99, 'stock' => 50, 'image' => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?q=80&w=1000', 'desc' => 'A classic black cap to go with any outfit.'],
            ['name' => 'Vintage Snapback', 'category_id' => 1, 'price' => 29.99, 'stock' => 30, 'image' => 'https://images.unsplash.com/photo-1556306535-0f09a536f0b1?q=80&w=1000', 'desc' => 'Vintage style snapback hat.'],
            ['name' => 'White Cotton T-Shirt', 'category_id' => 2, 'price' => 19.99, 'stock' => 100, 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1000', 'desc' => 'Premium white cotton t-shirt.'],
            ['name' => 'Graphic Print T-Shirt', 'category_id' => 2, 'price' => 24.99, 'stock' => 45, 'image' => 'https://images.unsplash.com/photo-1503342394128-c104d54dba01?q=80&w=1000', 'desc' => 'Comfortable graphic print tee.'],
            ['name' => 'Grey Minimalist Hoodie', 'category_id' => 3, 'price' => 59.99, 'stock' => 40, 'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=1000', 'desc' => 'Warm and cozy minimalist grey hoodie.'],
            ['name' => 'Black Zip-Up Hoodie', 'category_id' => 3, 'price' => 64.99, 'stock' => 35, 'image' => 'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?q=80&w=1000', 'desc' => 'Everyday black zip-up hoodie.'],
            ['name' => 'Denim Jeans', 'category_id' => 4, 'price' => 49.99, 'stock' => 60, 'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?q=80&w=1000', 'desc' => 'Classic blue denim jeans.'],
            ['name' => 'Cargo Pants', 'category_id' => 4, 'price' => 54.99, 'stock' => 25, 'image' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?q=80&w=1000', 'desc' => 'Utility cargo pants with multiple pockets.'],
        ];

        foreach ($productData as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'slug' => Str::slug($p['name']),
                    'category_id' => $p['category_id'],
                    'description' => $p['desc'],
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'image' => $p['image'],
                ]
            );
        }

        // Mock Orders
        $customers = [
            ['name' => 'John Doe', 'email' => 'john@example.com'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['name' => 'Michael Ross', 'email' => 'mike@example.com'],
        ];

        foreach ($customers as $c) {
            $order = Order::create([
                'customer_name' => $c['name'],
                'customer_email' => $c['email'],
                'customer_phone' => '123456789',
                'address' => '123 Street, City, Country',
                'total' => 0,
                'status' => 'pending',
            ]);

            $total = 0;
            $items = Product::inRandomOrder()->take(rand(1, 3))->get();
            foreach ($items as $item) {
                $qty = rand(1, 2);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $qty,
                    'price' => $item->price,
                ]);
                $total += $item->price * $qty;
            }
            $order->update(['total' => $total]);
        }
    }
}
