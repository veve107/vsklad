<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'id' => 1,
            'name' => "Laptop",
            'type' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('types')->insert([
            'id' => 2,
            'name' => "Počítač",
            'type' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('types')->insert([
            'id' => 3,
            'name' => "Myš",
            'type' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('types')->insert([
            'id' => 4,
            'name' => "Taška",
            'type' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('types')->insert([
            'id' => 5,
            'name' => "Klávesnica",
            'type' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('types')->insert([
            'id' => 6,
            'name' => "Monitor",
            'type' => 6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
