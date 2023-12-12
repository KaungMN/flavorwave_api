<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\DepartmentSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            DepartmentSeeder::class,
            RoleSeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            SupplierSeeder::class,
        ]);
    }
}
