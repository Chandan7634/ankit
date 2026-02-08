<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Using the factory to create 10 users
        // User::factory()->count(10)->create();

        $this->call([
            \Database\Seeders\CreateAdminUserSeeder::class,
            PlantSettingSeeder::class,
            PlantCouponSeeder::class,
            PlantShippingSeeder::class,
            PlantBannerSeeder::class,
            PlantCategorySeeder::class,
            PlantProductSeeder::class,
        ]);
    }
}
