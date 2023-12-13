<?php

namespace Database\Seeders;

use App\Models\RawMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $raw_materials = [
            [
                'name1' => 'Pineapple juice', 'supplier_id' => 1, 'price1' => '3000ks', 'weight1' => 200.4, 'demand_date' => '2023-12-22',
                'name2' => 'Pineapple juice', 'supplier_id' => 1, 'price2' => '3000ks', 'weight2' => 200.4, 'demand_date' => '2023-12-22',
                'name3' => 'Pineapple juice', 'supplier_id' => 1, 'price3' => '3000ks', 'weight3' => 200.4, 'demand_date' => '2023-12-22',
                'name4' => 'Pineapple juice', 'supplier_id' => 1, 'price4' => '3000ks', 'weight4' => 200.4, 'demand_date' => '2023-12-22',
                'demand_date' => '2023/6/22'
            ],
            // ['name' => 'Mint', 'supplier_id' => 1, 'price' => '3000ks', 'weight' => 200.4, 'demand_date' => '2023-12-22'],
            // ['name' => 'Conconut water', 'supplier_id' => 2, 'price' => '5000ks', 'weight' => 200.4, 'demand_date' => '2023-12-22'],
            // ['name' => 'Agave syrup', 'supplier_id' => 1, 'price' => '2000ks', 'weight' => 200.4, 'demand_date' => '2023-12-22'],

        ];

        foreach ($raw_materials as $raw) {
            RawMaterial::create([
                'name1' => $raw['name1'],
                'supplier_id' => $raw['supplier_id'],
                'price1' => $raw['price1'],
                'weight1' => $raw['weight1'],
                'demand_date' => $raw['demand_date'],
                'product_id' => 1,

                'name2' => $raw['name2'],
                'supplier_id' => $raw['supplier_id'],
                'price2' => $raw['price2'],
                'weight2' => $raw['weight2'],
                'demand_date' => $raw['demand_date'],
                'product_id' => 1,

                'name3' => $raw['name3'],
                'supplier_id' => $raw['supplier_id'],
                'price3' => $raw['price3'],
                'weight3' => $raw['weight3'],
                'demand_date' => $raw['demand_date'],
                'product_id' => 1,

                'name4' => $raw['name4'],
                'supplier_id' => $raw['supplier_id'],
                'price4' => $raw['price4'],
                'weight4' => $raw['weight4'],
                'demand_date' => $raw['demand_date'],
                'product_id' => 1
            ]);
        }
    }
}
