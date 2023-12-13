<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_name = ['Admin', 'Manager', 'Senior Staff', 'Junior Staff'];

        foreach ($role_name as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
