<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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
            // Add more products as needed
        ];

        $imageDirectory = public_path('images/product');
        $imageFiles = File::files($imageDirectory);

        foreach ($products as $key => $product) {
            // Get the image file for the current product
            $imageFile = $imageFiles[$key] ?? null;

            // Create product only if the image file exists
            if ($imageFile) {
                Product::create([
                    'name' => $product['name'],
                    'photo' => '/images/product/' . $imageFile->getFilename(),
                    'price' => $product['price'],
                    'description' => $product['description'],
                ]);
            }
        }
    }
}
