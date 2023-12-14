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
            ['name' => 'Burmese Bliss','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Golden Sunshine Tea','price'=>200.00,'description'=>'This is description'],
            ['name' => 'Mango Tango Delight','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Rangoon Rosewater Elixir','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Emerald Green Chai','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Citurs Fusion Fizz','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Coconut Cream Dream','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Jasmine Srenade Soda','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Papaya Paradise Punch','price'=>100.00,'description'=>'This is description'],
            ['name' => 'Lychee Lullaby','price'=>100.00,'description'=>'This is description']
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'photo' => '/product.png',
                'price' => $product['price'],
                'description' => $product['description'],
            ]);
        }
    }
}
