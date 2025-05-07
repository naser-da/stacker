<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'name' => 'John Doe',
                'phone' => '555-0101',
                'address' => '123 Main St, Cityville'
            ],
            [
                'name' => 'Jane Smith',
                'phone' => '555-0102',
                'address' => '456 Oak Ave, Townsville'
            ],
            [
                'name' => 'Robert Johnson',
                'phone' => '555-0103',
                'address' => '789 Pine Rd, Villageton'
            ],
            [
                'name' => 'Emily Davis',
                'phone' => '555-0104',
                'address' => '321 Elm St, Metropolis'
            ],
            [
                'name' => 'Michael Wilson',
                'phone' => '555-0105',
                'address' => '654 Maple Dr, Suburbia'
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
} 