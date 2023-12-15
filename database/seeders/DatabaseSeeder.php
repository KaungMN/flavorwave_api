<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RawMaterial;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\RawMaterialSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            // DepartmentSeeder::class,
            // RoleSeeder::class,
            // CustomerSeeder::class,
            // RawMaterialSeeder::class,
            ProductSeeder::class,
            // SupplierSeeder::class,
        ]);
    }
}
