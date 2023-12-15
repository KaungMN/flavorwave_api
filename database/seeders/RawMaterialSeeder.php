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
                'product_id' => 1,'name1' => 'Black tea leaves', 'supplier_id' => 3, 'price1' => '3000ks', 'weight1' => 3000, 'demand_date' => '2023-12-22','photo1' => 'default.png',
                'name2' => 'Lemongrass',  'price2' => '3000ks', 'weight2' => 1500,'photo2' => 'default.png',
                'name3' => 'Ginger',  'price3' => '3000ks', 'weight3' => 750,'photo3' => 'default.png',
                'name4' => 'Honey',  'price4' => '3000ks', 'weight4' => 2,250,'photo4' => 'default.png',
            ],
            [
                'product_id' => 2,'name1' => 'Green tea leaves', 'supplier_id' => 1, 'price1' => '3000ks', 'weight1' => 3,600, 'demand_date' => '2023-12-22','photo1' => 'default.png',
                'name2' => 'Turmeric',  'price2' => '3000ks', 'weight2' => 1,200,'photo2' => 'default.png',
                'name3' => 'Lemon peel',  'price3' => '3000ks', 'weight3' => 800,'photo3' => 'default.png',
                'name4' => 'Chamomile',  'price4' => '3000ks', 'weight4' => 400,'photo4' => 'default.png',
            ],
            [
                'product_id' => 3,'name1' => 'Mango puree', 'supplier_id' => 2, 'price1' => '3000ks', 'weight1' => 7,500, 'demand_date' => '2023-12-22','photo1' => 'default.png',
                'name2' => 'Black tea leaves',  'price2' => '3000ks', 'weight2' => 3,750,'photo2' => 'default.png',
                'name3' => 'Orange zest',  'price3' => '3000ks', 'weight3' => 1,250,'photo3' => 'default.png',
                'name4' => 'Vanilla',  'price4' => '3000ks', 'weight4' =>  750,'photo4' => 'default.png',
            ],
            [
                'product_id' => 4,'name1' => 'Rose petals', 'supplier_id' => 5, 'price1' => '3000ks', 'weight1' => 2,160, 'demand_date' => '2023-12-22','photo1' => 'default.png',
                'name2' => 'Hibiscus',  'price2' => '3000ks', 'weight2' =>  1,440,'photo2' => 'default.png',
                'name3' => 'Elderflower',  'price3' => '3000ks', 'weight3' => 1080,'photo3' => 'default.png',
                'name4' => 'Rhubarb',  'price4' => '3000ks', 'weight4' => 720,'photo4' => 'default.png',
            ],
            [
                'product_id' => 5,'name1' => 'Green tea leaves', 'supplier_id' => 4, 'price1' => '3000ks', 'weight1' => 3,520, 'demand_date' => '2023-12-22','photo1' => 'default.png',
                'name2' => 'Cardamom',  'price2' => '3000ks', 'weight2' => 880,'photo2' => 'default.png',
                'name3' => 'Cinnamon',  'price3' => '3000ks', 'weight3' => 660,'photo3' => 'default.png',
                'name4' => 'Cloves',  'price4' => '3000ks', 'weight4' => 440,'photo4' => 'default.png',
            ],[
                'product_id' => 6,'name1' => 'Orange juice', 'supplier_id' => 1, 'price1' => '4000ks', 'weight1' => 3600, 'photo1'=>'default.png','demand_date' => '2023-12-22',
                'name2' => 'Lime juice',  'price2' => '3000ks', 'weight2' => 1800,'photo2'=>'default.png',
                'name3' => 'Lemon zest:',  'price3' => '3000ks', 'weight3' => 600, 'photo3'=>'default.png',
                'name4' => 'Sparkling water',  'price4' => '3000ks', 'weight4' => 2400, 'photo4'=>'default.png',

            ],
            [
                'product_id' => 7,'name1' => 'Coconut milk', 'supplier_id' => 2, 'price1' => '3000ks', 'weight1' => 200, 'photo1'=>'default.png','demand_date' => '2023-12-22',
                'name2' => 'Pineapple juice',  'price2' => '3000ks', 'weight2' => 50.4,'photo2'=>'default.png',
                'name3' => 'Cream',  'price3' => '3000ks', 'weight3' => 80.4, 'photo3'=>'default.png',
                'name4' => 'Agave syrup',  'price4' => '3000ks', 'weight4' => 2000, 'photo4'=>'default.png',

            ],
            [
                'product_id' => 8,'name1' => 'Jasmine tea leaves', 'supplier_id' => 3, 'price1' => '3000ks', 'weight1' => 2004, 'photo1'=>'default.png','demand_date' => '2023-12-22',
                'name2' => 'Elderflower',  'price2' => '3000ks', 'weight2' => 1100,'photo2'=>'default.png',
                'name3' => 'Soda Water',  'price3' => '3000ks', 'weight3' => 1200, 'photo3'=>'default.png',
                'name4' => 'Sugar',  'price4' => '3000ks', 'weight4' => 2000, 'photo4'=>'default.png',

            ],
            [
                'product_id' => 9,'name1' => 'Papaya puree', 'supplier_id' => 1, 'price1' => '3000ks', 'weight1' => 3000, 'photo1'=>'default.png','demand_date' => '2023-12-22',
                'name2' => 'Guava juice',  'price2' => '3000ks', 'weight2' => 2004,'photo2'=>'default.png',
                'name3' => 'Passionfruit',  'price3' => '3000ks', 'weight3' => 2002, 'photo3'=>'default.png',
                'name4' => 'Mint',  'price4' => '3000ks', 'weight4' => 2000, 'photo4'=>'default.png',
            ],
            [
                'product_id' => 10,'name1' => 'Lychee puree', 'supplier_id' => 4, 'price1' => '3000ks', 'weight1' => 1700, 'photo1'=>'default.png','demand_date' => '2023-12-22',
                'name2' => 'White tea leaves',  'price2' => '3000ks', 'weight2' => 1500,'photo2'=>'default.png',
                'name3' => 'Rosewater',  'price3' => '3000ks', 'weight3' => 2000, 'photo3'=>'default.png',
                'name4' => 'Honey',  'price4' => '3000ks', 'weight4' => 2500, 'photo4'=>'default.png',

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
                'product_id' =>  $raw['product_id'],

                'name2' => $raw['name2'],
                'price2' => $raw['price2'],
                'weight2' => $raw['weight2'],

                'name3' => $raw['name3'],
                'price3' => $raw['price3'],
                'weight3' => $raw['weight3'],

                'name4' => $raw['name4'],
                'price4' => $raw['price4'],
                'weight4' => $raw['weight4'],
            ]);
        }

    }
}
