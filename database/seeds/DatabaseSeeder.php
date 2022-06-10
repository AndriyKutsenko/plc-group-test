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
        $this->call(CompaniesTableSeeder::class);
        $this->call(ModelsTableSeeder::class);
        $this->call(FuelTypesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
    }
}
