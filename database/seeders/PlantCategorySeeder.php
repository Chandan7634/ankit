<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks to allow updates
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing categories (optional, or just update them)
        // For this task, let's update existing ones to preserve IDs if possible, or truncate and re-seed
        // Truncating is cleaner for a "new" site feel
        DB::table('categories')->truncate();

        $categories = [
            [
                'title' => 'Indoor Plants',
                'slug' => 'indoor-plants',
                'summary' => 'Beautiful plants to purify your home air.',
                'photo' => '', // You might want to add default photos later
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Outdoor Plants',
                'slug' => 'outdoor-plants',
                'summary' => 'Plants that thrive under the open sky.',
                'photo' => '',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Flowering Plants',
                'slug' => 'flowering-plants',
                'summary' => 'Add a splash of color to your garden.',
                'photo' => '',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'title' => 'Succulents & Cacti',
                'slug' => 'succulents-cacti',
                'summary' => 'Low maintenance plants for busy people.',
                'photo' => '',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active',
            ],
             [
                'title' => 'Seeds',
                'slug' => 'seeds',
                'summary' => 'Grow your own vegetables and flowers.',
                'photo' => '',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active',
            ],
             [
                'title' => 'Pots & Planters',
                'slug' => 'pots-planters',
                'summary' => 'Stylish homes for your green friends.',
                'photo' => '',
                'is_parent' => 1,
                'parent_id' => null,
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'title' => $category['title'],
                'slug' => $category['slug'],
                'summary' => $category['summary'],
                'photo' => $category['photo'],
                'is_parent' => $category['is_parent'],
                'parent_id' => $category['parent_id'],
                'status' => $category['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        // Add some subcategories
        $indoorId = DB::table('categories')->where('slug', 'indoor-plants')->first()->id;
        $seedsId = DB::table('categories')->where('slug', 'seeds')->first()->id;

        $subCategories = [
            [
                'title' => 'Air Purifying',
                'slug' => 'air-purifying',
                'status' => 'active',
                'parent_id' => $indoorId,
                'is_parent' => 0,
            ],
             [
                'title' => 'Low Light',
                'slug' => 'low-light',
                'status' => 'active',
                 'parent_id' => $indoorId,
                'is_parent' => 0,
            ],
            [
                'title' => 'Vegetable Seeds',
                'slug' => 'vegetable-seeds',
                'status' => 'active',
                 'parent_id' => $seedsId,
                'is_parent' => 0,
            ],
             [
                'title' => 'Flower Seeds',
                'slug' => 'flower-seeds',
                'status' => 'active',
                 'parent_id' => $seedsId,
                'is_parent' => 0,
            ]
        ];

         foreach ($subCategories as $category) {
            DB::table('categories')->insert([
                'title' => $category['title'],
                'slug' => $category['slug'],
                'summary' => '',
                'photo' => '',
                'is_parent' => $category['is_parent'],
                'parent_id' => $category['parent_id'],
                'status' => $category['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
