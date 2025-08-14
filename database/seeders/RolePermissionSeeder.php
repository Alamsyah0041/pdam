<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-user']); 
        Permission::create(['name' => 'edit-user']); 
        Permission::create(['name' => 'delete-user']); 
        Permission::create(['name' => 'show-user']);  
 
        Permission::create(['name' => 'create-penulis']); 
        Permission::create(['name' => 'edit-penulis']); 
        Permission::create(['name' => 'delete-penulis']); 
        Permission::create(['name' => 'show-penulis']);  
         
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'operator']);
        Role::create(['name' => 'asmen']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'direktur']);
 
 
        $roleadmin = Role::findByName('admin');
        $roleadmin->givePermissionTo('create-user');
        $roleadmin->givePermissionTo('edit-user');
        $roleadmin->givePermissionTo('delete-user');
        $roleadmin->givePermissionTo('show-user');
 
        $roleoperator = Role::findByName('operator');
        $roleoperator->givePermissionTo('create-penulis');
        $roleoperator->givePermissionTo('edit-penulis');
        $roleoperator->givePermissionTo('delete-penulis');
        $roleoperator->givePermissionTo('show-penulis');
 
        $roleasmen = Role::findByName('asmen');
        $roleasmen->givePermissionTo('create-penulis');
        $roleasmen->givePermissionTo('edit-penulis');
        $roleasmen->givePermissionTo('delete-penulis');
        $roleasmen->givePermissionTo('show-penulis');
     
        $rolemanager = Role::findByName('manager');
        $rolemanager->givePermissionTo('create-penulis');
        $rolemanager->givePermissionTo('edit-penulis');
        $rolemanager->givePermissionTo('delete-penulis');
        $rolemanager->givePermissionTo('show-penulis');
 
        $roledirektur = Role::findByName('direktur');
        $roledirektur->givePermissionTo('create-penulis');
        $roledirektur->givePermissionTo('edit-penulis');
        $roledirektur->givePermissionTo('delete-penulis');
        $roledirektur->givePermissionTo('show-penulis');
 


    }
}
