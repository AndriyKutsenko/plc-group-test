<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelsTableSeeder extends Seeder
{
    static $companies = [
        1 => ['A4', 'Q7', 'R8'],
        2 => ['328', '535i', '750L'],
        3 => ['E320', 'S600', 'G63'],
        4 => ['Polo', 'Golf', 'Passat'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$companies as $key => $value) {
            foreach ($value as $model) {
                DB::table('models')->insert([
                    'company_id' => $key,
                    'name' => $model,
                ]);
            }
        }
    }
}
