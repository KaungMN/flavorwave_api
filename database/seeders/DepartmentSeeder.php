<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = [
            ['name' => 'Admin'],
            ['name' => 'Sales'],
            ['name' => 'Logistics'],
            ['name' => 'Warehouse'],
            ['name' => 'Factory'],
        ];


        foreach ($departments as $d) {
            Department::create([
                'name' => $d['name']
            ]);
        }
    }
}
