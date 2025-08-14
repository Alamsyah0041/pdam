<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'password' => bcrypt('admin')
        ]);
        $admin->assignRole('admin'); // Assign role 'admin'

        $operator = User::create([
            'email' => 'operator@gmail.com',
            'name' => 'operator',
            'password' => bcrypt('operator')
        ]);
        $operator->assignRole('operator'); // Assign role 'operator'

        $asmen = User::create([
            'email' => 'asmen@gmail.com',
            'name' => 'asmen',
            'password' => bcrypt('asmen')
        ]);
        $asmen->assignRole('asmen'); // Assign role 'asmen'

        $manager = User::create([
            'email' => 'manager@gmail.com',
            'name' => 'manager', 
            'password' => bcrypt('manager') 
        ]);
        $manager->assignRole('manager'); // Assign role 'manager'

        $direktur = User::create([
            'email' => 'direktur@gmail.com',
            'name' => 'direktur',
            'password' => bcrypt('direktur')
        ]);
        $direktur->assignRole('direktur'); // Assign role 'direktur'
    }
}
