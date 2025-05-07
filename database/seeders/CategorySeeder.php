<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'icon' => 'laptop'
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and fashion items',
                'icon' => 'shirt'
            ],
            [
                'name' => 'Home & Kitchen',
                'description' => 'Home appliances and kitchenware',
                'icon' => 'home'
            ],
            [
                'name' => 'Books',
                'description' => 'Books and publications',
                'icon' => 'book'
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports equipment and accessories',
                'icon' => 'sports'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 