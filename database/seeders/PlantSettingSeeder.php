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
            'photo' => 'logo.png',
            'logo' => 'logo.png',
            'address' => '123 Green Street, Plant City, PC 12345',
            'phone' => '+1 234 567 890',
            'email' => 'info@fulvari.com',
        ];
        DB::table('settings')->insert($data);
    }
}
