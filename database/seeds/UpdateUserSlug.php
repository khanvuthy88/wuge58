<?php

use Illuminate\Database\Seeder;
use App\User;
class UpdateUserSlug extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$users=User::all();
       	foreach ($users as $user) {
       		$user->update('slug',$user->id.'-'.$user->name);
       	}
    }
}
