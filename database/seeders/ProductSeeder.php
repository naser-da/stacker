<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Electronics
            [
                'name' => 'Smartphone X',
                'description' => 'Latest model smartphone with advanced features',
                'image' => 'products/smartphone.jpg',
                'price' => 999.99,
                'cost' => 700.00,
                'profit' => 299.99,
                'category_id' => 1
            ],
            [
                'name' => 'Laptop Pro',
                'description' => 'High-performance laptop for professionals',
                'image' => 'products/laptop.jpg',
                'price' => 1499.99,
                'cost' => 1100.00,
                'profit' => 399.99,
                'category_id' => 1
            ],
            // Clothing
            [
                'name' => 'Designer T-Shirt',
                'description' => 'Premium cotton t-shirt with modern design',
                'image' => 'products/tshirt.jpg',
                'price' => 29.99,
                'cost' => 15.00,
                'profit' => 14.99,
                'category_id' => 2
            ],
            [
                'name' => 'Denim Jeans',
                'description' => 'Classic fit denim jeans',
                'image' => 'products/jeans.jpg',
                'price' => 79.99,
                'cost' => 40.00,
                'profit' => 39.99,
                'category_id' => 2
            ],
            // Home & Kitchen
            [
                'name' => 'Smart Coffee Maker',
                'description' => 'Programmable coffee maker with smart features',
                'image' => 'products/coffee-maker.jpg',
                'price' => 129.99,
                'cost' => 80.00,
                'profit' => 49.99,
                'category_id' => 3
            ],
            [
                'name' => 'Stainless Steel Cookware Set',
                'description' => '10-piece cookware set for modern kitchens',
                'image' => 'products/cookware.jpg',
                'price' => 199.99,
                'cost' => 120.00,
                'profit' => 79.99,
                'category_id' => 3
            ],
            // Books
            [
                'name' => 'Business Strategy Guide',
                'description' => 'Comprehensive guide to business strategy',
                'image' => 'products/business-book.jpg',
                'price' => 24.99,
                'cost' => 12.00,
                'profit' => 12.99,
                'category_id' => 4
            ],
            [
                'name' => 'Programming Fundamentals',
                'description' => 'Learn programming from scratch',
                'image' => 'products/programming-book.jpg',
                'price' => 39.99,
                'cost' => 20.00,
                'profit' => 19.99,
                'category_id' => 4
            ],
            // Sports
            [
                'name' => 'Professional Yoga Mat',
                'description' => 'High-quality yoga mat for professionals',
                'image' => 'products/yoga-mat.jpg',
                'price' => 49.99,
                'cost' => 25.00,
                'profit' => 24.99,
                'category_id' => 5
            ],
            [
                'name' => 'Running Shoes',
                'description' => 'Comfortable running shoes for all terrains',
                'image' => 'products/running-shoes.jpg',
                'price' => 89.99,
                'cost' => 45.00,
                'profit' => 44.99,
                'category_id' => 5
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 