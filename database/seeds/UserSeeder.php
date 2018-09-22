<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Role::find(1);
        $employee = new User();
	    $employee->name = 'Khan Vuthy';
	    $employee->email = 'khanvuthy88@gmail.com';
	    $employee->password = bcrypt('admin007');
	    $employee->save();
	    $employee->Roles()->attach($role);
    }
}
