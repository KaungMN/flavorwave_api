<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Burmese Bliss', 'price' => 4000.00, 'description' => 'desc'],
            ['name' => 'Golden Sunshine Tea', 'price' => 4000.00, 'description' => 'desc'],
            ['name' => 'Mango Tango Delight', 'price' => 4000.00, 'description' => 'desc'],
            ['name' => 'Rangoon Rosewater Elixir', 'price' => 4000.00, 'description' => 'desc'],
            // ['name' => 'Emerald Green Chai'],
            // ['name' => 'Citurss Fusion Fizz'],
            // ['name' => 'Coconut Cream Dream'],
            // ['name' => 'Jasmine Srenade Soda'],
            // ['name' => 'Papaya Paradise Punch'],
            // ['name' => 'Lychee Lullaby']
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'photo' => '/images/product/sample8.jpg',
                'price' => $product['price'],
                'description' => $product['description'],
            ]);
        }
    }
}
