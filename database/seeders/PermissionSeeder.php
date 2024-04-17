<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'lihat-data-user']);
        Permission::create(['name'=>'tambah-data-user']);
        Permission::create(['name'=>'edit-data-user']);
        Permission::create(['name'=>'hapus-data-user']);
       
        Permission::create(['name'=>'tambah-data-fk-prodi']);
        Permission::create(['name'=>'edit-data-fk-prodi']);
        Permission::create(['name'=>'hapus-data-fk-prodi']);

        Permission::create(['name'=> 'lihat-data-fk-prodi']);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'dosen']);
        Role::create(['name'=>'mahasiswa']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('lihat-data-user');
        $roleAdmin->givePermissionTo('tambah-data-user');
        $roleAdmin->givePermissionTo('edit-data-user');
        $roleAdmin->givePermissionTo('hapus-data-user');
        $roleAdmin->givePermissionTo('tambah-data-fk-prodi');
        $roleAdmin->givePermissionTo('edit-data-fk-prodi');
        $roleAdmin->givePermissionTo('hapus-data-fk-prodi');
        $roleAdmin->givePermissionTo('lihat-data-fk-prodi');


        $roleDosen = Role::findByName('dosen');
        $roleDosen->givePermissionTo('edit-data-fk-prodi');
        $roleDosen->givePermissionTo('hapus-data-fk-prodi');
        $roleDosen->givePermissionTo('lihat-data-fk-prodi');

        $roleMahasiswa = Role::findByName('mahasiswa');
        $roleMahasiswa->givePermissionTo('lihat-data-fk-prodi');


    }
}
