<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_user = Role::where('rolename', 'user')->first();
        $role_admin = Role::where('rolename', 'admin')->first();

        $user = new User();
        $user->username = 'User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('secret');
        //https://stackoverflow.com/questions/27765377/how-to-insert-record-with-many-belongsto-relations-in-laravel-eloquent
        $user->role()->associate($role_user);
        $user->save();
        //$user->role()->associate($role_user);

        $user = new User();
        $user->username = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->role()->associate($role_admin);
        $user->save();
        //$user->roles()->attach($role_user);

        $user = new User();
        $user->username = 'Ronald';
        $user->email = 'ronald@example.com';
        $user->role()->associate($role_user);
        $user->password = bcrypt('secret');
        $user->save();
        //$user->roles()->attach($role_user);

        $user = new User();
        $user->username = 'Joaquin';
        $user->email = 'joaquin@example.com';
        $user->password = bcrypt('secret');
        $user->role()->associate($role_user);
        $user->save();
        //$user->roles()->attach($role_user);
    }
}
