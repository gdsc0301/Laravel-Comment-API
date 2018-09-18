<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_writter = new Role();
      $role_writter->name = 'writter';
      $role_writter->description = 'A Writter User';
      $role_writter->save();

      $role_admin = new Role();
      $role_admin->name = 'admin';
      $role_admin->description = 'A Admin User';
      $role_admin->save();
    }
}
