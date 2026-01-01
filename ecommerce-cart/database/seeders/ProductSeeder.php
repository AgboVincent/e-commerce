<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Wireless Mouse',
                'price' => 25.99,
                'stock_quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mechanical Keyboard',
                'price' => 89.99,
                'stock_quantity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'USB-C Charger',
                'price' => 19.99,
                'stock_quantity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop Stand',
                'price' => 45.00,
                'stock_quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Noise Cancelling Headphones',
                'price' => 199.99,
                'stock_quantity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Webcam',
                'price' => 59.99,
                'stock_quantity' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Portable SSD',
                'price' => 129.99,
                'stock_quantity' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bluetooth Speaker',
                'price' => 75.00,
                'stock_quantity' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smart Watch',
                'price' => 149.99,
                'stock_quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phone Tripod',
                'price' => 29.99,
                'stock_quantity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
