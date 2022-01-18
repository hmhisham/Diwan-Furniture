<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'هشام أحمد',
            'email' => 'hm.hisham@gmail.com',
            'password' => bcrypt('Hmhisham'),
            'roles_name' => ["owner"],
            'Status' => 'مفعل',
        ]);
        $role = Role::create(['name' => 'owner']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'حسن محسن',
            'email' => 'hassan@gmail.com',
            'password' => bcrypt('123456'),
            'roles_name' => ["مدير"],
            'Status' => 'مفعل',
        ]);
        $role = Role::create(['name' => 'مدير']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
