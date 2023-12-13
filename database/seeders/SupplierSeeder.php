<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $suppliers = [
            ['name' => 'Mg Mg', 'email' => 'mgmg@gmail.com', 'phone' => '09728273672', 'address' => 'Mandalay'],
            ['name' => 'Kyaw Kyaw', 'email' => 'kyawkyaw@gmail.com', 'phone' => '09383782', 'address' => 'Bago'],
            ['name' => 'Hla Hla', 'email' => 'hlahla@gmail.com', 'phone' => '098365381', 'address' => 'Yangon'],
            ['name' => 'Aung Aung', 'email' => 'agag@gmail.com', 'phone' => '097362827', 'address' => 'Yangon'],
            ['name' => 'Su Su', 'email' => 'susu@gmail.com', 'phone' => '098373628', 'address' => 'Mandalay'],
            ['name' => 'Ko Ko', 'email' => 'koko@gmail.com', 'phone' => '097363627', 'address' => 'Taungyi'],
        ];


        foreach ($suppliers as $supplier) {
            Supplier::create([
                'name' => $supplier['name'],
                'email' => $supplier['email'],
                'phone' => $supplier['phone'],
                'address' => $supplier['address']
            ]);
        }
    }
}