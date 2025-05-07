<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        // Create some sample sales
        $sales = [
            [
                'customer_id' => 1,
                'total_amount' => 1079.98,
                'status' => 'completed',
                'notes' => 'First purchase'
            ],
            [
                'customer_id' => 2,
                'total_amount' => 159.98,
                'status' => 'completed',
                'notes' => 'Regular customer'
            ],
            [
                'customer_id' => 3,
                'total_amount' => 329.97,
                'status' => 'completed',
                'notes' => 'Bulk purchase'
            ],
            [
                'customer_id' => 4,
                'total_amount' => 64.98,
                'status' => 'completed',
                'notes' => 'Online order'
            ],
            [
                'customer_id' => 5,
                'total_amount' => 139.98,
                'status' => 'completed',
                'notes' => 'Store pickup'
            ]
        ];

        // Create sales and their items
        foreach ($sales as $index => $saleData) {
            $sale = Sale::create($saleData);

            // Create 1-3 items for each sale
            $numItems = rand(1, 3);
            for ($i = 0; $i < $numItems; $i++) {
                $productId = rand(1, 10); // Assuming we have 10 products
                $quantity = rand(1, 3);
                $price = rand(20, 100); // Random price between 20 and 100
                $subtotal = $price * $quantity;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal
                ]);
            }
        }
    }
} 