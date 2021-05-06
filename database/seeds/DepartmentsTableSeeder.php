<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'id' => '1',
            'name' => 'HR',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('departments')->insert([
            'id' => '2',
            'name' => 'IT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('departments')->insert([
            'id' => '3',
            'name' => 'Marketing',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
