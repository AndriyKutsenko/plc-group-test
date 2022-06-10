<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    static $companies = [
        'USA',
        'Germany',
        'Japan',
        'Zimbabve',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$companies as $value) {
            DB::table('countries')->insert([
                'name' => $value
            ]);
        }
    }
}
