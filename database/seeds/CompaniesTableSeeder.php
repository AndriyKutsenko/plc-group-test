<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    static $companies = [
        'Audi',
        'BMW',
        'Mercedes',
        'VW',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$companies as $value) {
            DB::table('companies')->insert([
                'name' => $value
            ]);
        }
    }
}
