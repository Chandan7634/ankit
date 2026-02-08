<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PlantProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Disable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         
         // Truncate products to start fresh
         DB::table('products')->truncate();

         // Get category IDs
         $indoor = DB::table('categories')->where('slug', 'indoor-plants')->first();
         $outdoor = DB::table('categories')->where('slug', 'outdoor-plants')->first();
         $succulent = DB::table('categories')->where('slug', 'succulents-cacti')->first();
         $flowering = DB::table('categories')->where('slug', 'flowering-plants')->first();

         $products = [
            [
                'title' => 'Snake Plant (Sansevieria)',
                'summary' => 'The perfect bedroom plant. Air purifying and low light tolerant.',
                'description' => '<p>The Snake Plant, also known as Mother-in-Law\'s Tongue, is one of the most popular and hardy houseplants. It features stiff, sword-like leaves that grow vertically.</p><p><strong>Care Instructions:</strong></p><ul><li><strong>Light:</strong> Thrives in low to bright indirect light.</li><li><strong>Water:</strong> Allow soil to dry completely between waterings.</li></ul>',
                'photo' => 'pro2.jpg', // Placeholder, using existing images or we need to upload new ones? Using placeholders for now.
                'stock' => 50,
                'size' => 'S,M,L', // Pot sizes
                'condition' => 'new',
                'status' => 'active',
                'price' => 499.00,
                'discount' => 10,
                'is_featured' => 1,
                'cat_id' => $indoor ? $indoor->id : null,
                'brand_id' => null, // No brand
            ],
            [
                'title' => 'Monstera Deliciosa',
                'summary' => 'The Swiss Cheese Plant. Iconic split leaves for a tropical vibe.',
                'description' => '<p>Monstera Deliciosa is famous for its natural leaf holes. It\'s a climbing evergreen that can grow quite large indoors.</p><p><strong>Care:</strong> Needs bright, indirect light and regular watering.</p>',
                'photo' => 'pro3.jpg',
                'stock' => 30,
                'size' => 'M,L,XL',
                'condition' => 'hot',
                'status' => 'active',
                'price' => 1299.00,
                'discount' => 15,
                'is_featured' => 1,
                'cat_id' => $indoor ? $indoor->id : null,
                'brand_id' => null,
            ],
            [
                'title' => 'Aloe Vera',
                'summary' => 'Medicinal succulent that soothes skin and purifies air.',
                'description' => '<p>Aloe Vera is a succulent plant species of the genus Aloe. It is widely cultivated for agricultural and medicinal uses.</p>',
                'photo' => 'pro4.jpg',
                'stock' => 100,
                'size' => 'S,M',
                'condition' => 'default',
                'status' => 'active',
                'price' => 299.00,
                'discount' => 5,
                'is_featured' => 0,
                'cat_id' => $succulent ? $succulent->id : null,
                'brand_id' => null,
            ],
            [
                'title' => 'Peace Lily',
                'summary' => 'Elegant white flowers and lush green leaves.',
                'description' => '<p>Peace Lilies are a favorite houseplant, offering majestic, long-lasting white blooms which commonly appear in spring.</p>',
                'photo' => 'pro1.jpg',
                'stock' => 40,
                'size' => 'M,L',
                'condition' => 'new',
                'status' => 'active',
                'price' => 899.00,
                'discount' => 12,
                'is_featured' => 1,
                'cat_id' => $flowering ? $flowering->id : null,
                 'brand_id' => null,
            ],
             [
                'title' => 'Fiddle Leaf Fig',
                'summary' => 'Statement tree with large, violin-shaped leaves.',
                'description' => '<p>The Fiddle Leaf Fig is a popular indoor tree featuring very large, heavily veined, and glossy violin-shaped leaves.</p>',
                'photo' => 'pro5.png', // Assuming existing image
                'stock' => 15,
                'size' => 'L,XL',
                'condition' => 'hot',
                'status' => 'active',
                'price' => 2499.00,
                'discount' => 0,
                'is_featured' => 1,
                'cat_id' => $indoor ? $indoor->id : null,
                 'brand_id' => null,
            ],
            [
                'title' => 'Boston Fern',
                'summary' => 'Classic fern with arching fronds, perfect for hanging baskets.',
                'description' => '<p>Boston ferns are popular house plants that offer lush, feathery foliage. They love humidity and indirect light.</p>',
                'photo' => 'pro6.jpg',
                'stock' => 25,
                'size' => 'M,L',
                'condition' => 'default',
                'status' => 'active',
                'price' => 350.00,
                'discount' => 0,
                'is_featured' => 0,
                'cat_id' => $indoor ? $indoor->id : null,
                'brand_id' => null,
            ],
            [
                'title' => 'Areca Palm',
                'summary' => 'Air purifying palm that adds a tropical touch.',
                'description' => '<p>The Areca Palm is a popular indoor palm tree. It is known for its air-purifying properties and feathery, arching fronds.</p>',
                'photo' => 'pro7.jpg',
                'stock' => 10,
                'size' => 'XL,2XL',
                'condition' => 'hot',
                'status' => 'active',
                'price' => 1500.00,
                'discount' => 10,
                'is_featured' => 1,
                'cat_id' => $indoor ? $indoor->id : null,
                'brand_id' => null,
            ],
            [
                'title' => 'Lavender Plant',
                'summary' => 'Fragrant herb that loves the sun.',
                'description' => '<p>Lavender is a Mediterranean herb known for its soothing fragrance and lovely purple flowers. Requires full sun.</p>',
                'photo' => 'pro8.jpg',
                'stock' => 50,
                'size' => 'S,M',
                'condition' => 'new',
                'status' => 'active',
                'price' => 450.00,
                'discount' => 5,
                'is_featured' => 1,
                'cat_id' => $outdoor ? $outdoor->id : null,
                'brand_id' => null,
            ],
            [
                'title' => 'Basil Herb',
                'summary' => 'Fresh culinary herb for your kitchen garden.',
                'description' => '<p>Basil is a must-have herb for any kitchen garden. It loves warmth and sunlight and needs regular watering.</p>',
                'photo' => 'pro9.jpg',
                'stock' => 100,
                'size' => 'S',
                'condition' => 'default',
                'status' => 'active',
                'price' => 150.00,
                'discount' => 0,
                'is_featured' => 0,
                'cat_id' => $outdoor ? $outdoor->id : null, // or herbs cat if we had one
                'brand_id' => null,
            ],
            [
                'title' => 'Rubber Plant',
                'summary' => 'Glossy leaves and robust growth.',
                'description' => '<p>The Rubber Plant is a popular houseplant with large, thick, glossy leaves. It is durable and easy to care for.</p>',
                'photo' => 'pro10.jpg',
                'stock' => 20,
                'size' => 'M,L',
                'condition' => 'default',
                'status' => 'active',
                'price' => 699.00,
                'discount' => 20,
                'is_featured' => 0,
                'cat_id' => $indoor ? $indoor->id : null,
                'brand_id' => null,
            ],
         ];

         foreach ($products as $product) {
            DB::table('products')->insert([
                'title' => $product['title'],
                'slug' => Str::slug($product['title']),
                'summary' => $product['summary'],
                'description' => $product['description'],
                'photo' => $product['photo'], // We might need to handle photos better
                'stock' => $product['stock'],
                'size' => $product['size'],
                'condition' => $product['condition'],
                'status' => $product['status'],
                'price' => $product['price'],
                'discount' => $product['discount'],
                'is_featured' => $product['is_featured'],
                'cat_id' => $product['cat_id'],
                'brand_id' => $product['brand_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

         DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
