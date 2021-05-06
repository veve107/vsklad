<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'id' => 1,
            'name' => "Lenovo",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('brands')->insert([
            'id' => 2,
            'name' => "HP",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
