<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'id' => '1',
            'name' => 'CEO',
        ]);
        DB::table('positions')->insert([
            'id' => '2',
            'name' => 'Zamestnanec',
        ]);
        DB::table('positions')->insert([
            'id' => '3',
            'name' => 'Brigadnik',
        ]);
    }
}
