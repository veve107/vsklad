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
            'role_id' => 1,
            'position_id' => 1,
            'name' => 'Veronika',
            'email' => 'admin@gmail.com',
            'department_id' => 1,
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'position_id' => 2,
            'name' => 'Michal',
            'email' => 'michal@gmail.com',
            'department_id' => 2,
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'position_id' => 2,
            'name' => 'Andrej',
            'email' => 'andrej@gmail.com',
            'department_id' => 2,
            'password' => bcrypt('password'),
        ]);
    }
}
