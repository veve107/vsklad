<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->insert([
            'id' => 1,
            'name' => "Y530",
            'brand_id' => 1,
            'type_id' => 1,
            'order_id' => 1,
            'serial_number' => "54341324",
            'inventory_number' => 20200101,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('devices')->insert([
            'id' => 2,
            'name' => "Stolovy PC",
            'brand_id' => 1,
            'type_id' => 2,
            'order_id' => 1,
            'serial_number' => "asd122r2d",
            'inventory_number' => 20200102,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('devices')->insert([
            'id' => 3,
            'name' => "Myš",
            'brand_id' => 1,
            'type_id' => 3,
            'order_id' => 1,
            'stock' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('devices')->insert([
            'id' => 4,
            'name' => "Taška",
            'brand_id' => 1,
            'type_id' => 4,
            'order_id' => 2,
            'stock' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('devices')->insert([
            'id' => 5,
            'name' => "Klávesnica",
            'brand_id' => 1,
            'type_id' => 5,
            'order_id' => 2,
            'stock' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('devices')->insert([
            'id' => 6,
            'name' => "Monitor",
            'brand_id' => 1,
            'type_id' => 6,
            'order_id' => 2,
            'stock' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
