<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('coupons')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $data=[
            [
                'code'=>'WELCOME10',
                'type'=>'fixed',
                'value'=>10,
                'status'=>'active'
            ],
            [
                'code'=>'PLANTLOVER',
                'type'=>'percent',
                'value'=>15,
                'status'=>'active'
            ]
        ];
        DB::table('coupons')->insert($data);
    }
}
