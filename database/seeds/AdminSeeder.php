<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = \Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => [
                'admin' => true,
            ]
        ]);

        $user = \Sentinel::registerAndActivate([
            'email'   => 'admin@admin.com',
            'username'  =>  'admin',
            'password'  =>  'password',
            'permissions' =>  [
                'admin' => true,
            ]
        ]);

        $role = \Sentinel::findRoleByName('Admin');
        $role->users()->attach($user);

        $user2 = \Sentinel::registerAndActivate([
            'email'     =>  'super@admin.com',
            'username'  =>  'rootadmin',
            'password'  =>  'password',
            'permissions' =>  [
                'admin' => true,
            ]
        ]);
        $role->users()->attach($user2);
    }
}
