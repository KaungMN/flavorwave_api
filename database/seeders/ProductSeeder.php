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
            ['name' => 'Burmese Bliss'],
            ['name' => 'Golden Sunshine Tea'],
            ['name' => 'Mango Tango Delight'],
            ['name' => 'Rangoon Rosewater Elixir'],
            ['name' => 'Emerald Green Chai'],
            ['name' => 'Citurs Fusion Fizz'],
            ['name' => 'Coconut Cream Dream'],
            ['name' => 'Jasmine Srenade Soda'],
            ['name' => 'Papaya Paradise Punch'],
            ['name' => 'Lychee Lullaby']
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'photo' => 'product.png'
            ]);
        }
    }
}
