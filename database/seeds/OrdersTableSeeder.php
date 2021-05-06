<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'id' => '1',
            'order_number' => '123113213',
            'delivery_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_of_warranty' => Carbon::now()->addYears(2)->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('orders')->insert([
            'id' => '2',
            'order_number' => '11551231',
            'delivery_date' => Carbon::now()->subDays(30)->format('Y-m-d H:i:s'),
            'end_of_warranty' => Carbon::now()->subDays(30)->addYears(2)->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
