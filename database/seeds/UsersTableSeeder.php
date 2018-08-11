<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'role_id' => 1,
            'phone_no' => 0,
            'password' => bcrypt('secret'),
        ]);
        DB::table('roles')->insert([
            'role'=>'Admin'
        ]);
        DB::table('roles')->insert([
            'role'=>'User'
        ]);
    }
}
