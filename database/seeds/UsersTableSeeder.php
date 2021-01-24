<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'gebruiker',
            'role' => 'Admin',
            'type' => 'medewerker EhB',
            'email' => 'user1@email.com',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'role' => 'Admin',
            'type' => 'medewerker EhB',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'uitleendienst',
            'role' => 'Uitleendienst',
            'type' => 'Docent',
            'email' => 'uitleendienst@email.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'role' => 'User',
            'type' => 'Student',
            'email' => 'user@email.com',
            'password' => bcrypt('123456'),
        ]);

    }
}
