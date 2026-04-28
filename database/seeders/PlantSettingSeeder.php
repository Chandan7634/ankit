<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'description' => 'Welcome to Fulvari, your one-stop shop for all things plants! We offer a wide variety of indoor and outdoor plants, pots, and gardening accessories.',
            'short_des' => 'Best Online Plant Store',
            'photo' => 'fulvari-logo.png',
            'logo' => 'fulvari-logo.png',
            'address' => 'Sri Krishna Puri Boring road Patna 800001.',
            'phone' => '+91 7667459049',
            'email' => 'info@fulvari.in',
        ];
        DB::table('settings')->insert($data);
    }
}
