<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('shippings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'type' => 'Standard',
                'price' => 0,
                'status' => 'active',
            ],
            [
                'type' => 'Express',
                'price' => 10,
                'status' => 'active',
            ],
        ];
        DB::table('shippings')->insert($data);
    }
}
