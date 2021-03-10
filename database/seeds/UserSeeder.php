<?php

use App\Repositories\MemberRepository;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = \Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => [
                'user' => true,
            ]
        ]);

        $user = \Sentinel::registerAndActivate([
            'email'   => 'user@user.com',
            'username'  =>  'user',
            'password'  =>  'password',
            'permissions' =>  [
                'user' => true,
            ]
        ]);

        $role = \Sentinel::findRoleByName('User');
        $role->users()->attach($user);

        $repo = new MemberRepository(new \App\Models\Member);
        $repo->store([
        	'user_id'	=>	$user->id,
            'package_id'    =>  1,
            'username'  =>  $user->username,
        	'parent_id'	=>	0,
            'level' => 1,
        	'package_amount'	=>	100
        ]);
    }
}
