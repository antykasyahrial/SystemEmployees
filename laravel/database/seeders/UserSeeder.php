<?php

namespace Database\Seeders;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Bcrypt\Bcrypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bcrypt = new Bcrypt();
        for($i = 0 ; $i < 3 ; $i++){
            $staff = Employee::create([
                'name'      => 'staff'.$i,
                'password'  => $bcrypt->encrypt('password'),
                'username'  => 'staff'.$i,
                'address'   => 'address'.$i,
                'jabatan'   => 'staff'
            ]);
            $staff->assignRole('staff');

            $supervisor = Employee::create([
                'name'      => 'supervisor'.$i,
                'password'  => $bcrypt->encrypt('password'),
                'username'  => 'supervisor'.$i,
                'address'   => 'address'.$i,
                'jabatan'   => 'supervisor'
            ]);
            $supervisor->assignRole('supervisor');

            $manager = Employee::create([
                'name'      => 'manager'.$i,
                'password'  => $bcrypt->encrypt('password'),
                'username'  => 'manager'.$i,
                'address'   => 'address'.$i,
                'jabatan'   => 'manager'
            ]);
            $manager->assignRole('manager');
        }
        
    }
}
