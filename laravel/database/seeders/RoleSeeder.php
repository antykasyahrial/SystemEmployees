<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'staff', 
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'supervisor',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'manager',
            'guard_name' => 'web'
        ]);
    }
}
