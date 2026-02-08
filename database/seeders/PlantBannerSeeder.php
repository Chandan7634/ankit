<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('banners')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data=[
            [
                'title'=>'Spring Sale',
                'slug'=>'spring-sale',
                'photo'=>'/storage/banner-1.png',
                'description'=>'Get 30% off on all indoor plants.',
                'status'=>'active',
            ],
            [
                'title'=>'New Arrivals',
                'slug'=>'new-arrivals',
                'photo'=>'/storage/banner-2.png',
                'description'=>'Check out our latest collection of ceramic pots.',
                'status'=>'active',
            ],
             [
                'title'=>'Outdoor Favorites',
                'slug'=>'outdoor-favorites',
                'photo'=>'/storage/banner-3.png',
                'description'=>'Beautify your garden with our outdoor range.',
                'status'=>'active',
            ]
        ];
        DB::table('banners')->insert($data);
    }
}
