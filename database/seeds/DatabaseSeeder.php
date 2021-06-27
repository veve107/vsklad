<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PositionsTableSeeder::class,
            RolesTableSeeder::class,
            DepartmentsTableSeeder::class,
            BrandsTableSeeder::class,
            TypesTableSeeder::class,
            OrdersTableSeeder::class,
            DevicesTableSeeder::class,
        ]);
    }
}
