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
        $user = App\User::create([
            'name'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => 'asdfasdf',
            'level'         => 'admin'
        ]);
    }
}
