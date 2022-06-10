<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelTypesTableSeeder extends Seeder
{
    static $companies = [
        'Petrol',
        'Diesel',
        'Electric',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$companies as $value) {
            DB::table('fuel_types')->insert([
                'name' => $value
            ]);
        }
    }
}
