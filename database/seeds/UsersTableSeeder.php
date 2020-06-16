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
            'role_id' => 1,
            'position_id' => 1,
            'name' => 'Veronika',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'position_id' => 2,
            'name' => 'Michal',
            'email' => 'michal@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
