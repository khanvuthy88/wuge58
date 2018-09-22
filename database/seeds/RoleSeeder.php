<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_array=[
        	['name'=>'Administrator'],
        	['name'=>'Super Admin'],
        	['name'=>'User']
        ];
        foreach ($role_array as $role) {
        	$role_obj=new Role();
        	$role_obj->name=$role['name'];
        	$role_obj->save();
        	$role_obj->slug=$role_obj->id.'-'.str_slug($role['name']);
        	$role_obj->save();
        }
    }
}

