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
            ['name' => 'Burmese Bliss', 'price' => 2000],
            ['name' => 'Golden Sunshine Tea', 'price' => 1500],
            ['name' => 'Mango Tango Delight', 'price' => 1800],
            ['name' => 'Rangoon Rosewater Elixir', 'price' => 2000],
            ['name' => 'Emerald Green Chai', 'price' => 3000],
            ['name' => 'Citurs Fusion Fizz', 'price' => 2300],
            ['name' => 'Coconut Cream Dream', 'price' => 2000],
            ['name' => 'Jasmine Srenade Soda', 'price' => 1500],
            ['name' => 'Papaya Paradise Punch', 'price' => 1800],
            ['name' => 'Lychee Lullaby', 'price' => 1400]
        ];

        foreach ($products as $product) {
            Product::create([
                'slug' => uniqid(),
                'name' => $product['name'],
                'price' => $product['price'],
                'photo' => 'product.png'
            ]);
        }
    }
}
