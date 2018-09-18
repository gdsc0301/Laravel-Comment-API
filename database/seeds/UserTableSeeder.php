<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_writter = Role::where('name', 'writter')->first();
      $role_admin  = Role::where('name', 'admin')->first();

      $writter = new User();
      $writter->name = 'Writter Name';
      $writter->email = 'writter@gmail.com';
      $writter->password = bcrypt('secret');
      $writter->save();
      
      $writter->roles()->attach($role_writter);
      $admin = new User();
      $admin->name = 'Admin Name';
      $admin->email = 'admin@gmail.com';
      $admin->password = bcrypt('secret');
      $admin->save();
      $admin->roles()->attach($role_admin);
    }
}
