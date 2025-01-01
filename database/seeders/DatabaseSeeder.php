<?php

namespace Database\Seeders;

use App\Models\Features;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'Ali',
            'last_name' => 'Admin',
            'phone' => '0999999999',
            'password' => '00000000',
            'role' => 'admin',
        ]);

        User::create([
            'first_name' => 'Amer',
            'last_name' => 'Driver',
            'phone' => '0888888888',
            'password' => '00000000',
            'role' => 'driver',
        ]);


        Store::create([
            'name' => 'متجر ملابس',
            'description' => 'جميع انواع الملابس',
            'image' => '/public/store_image/image1.jpeg',
        ]);

        Store::create([
            'name' => 'متجر مكياج',
            'description' => 'جميع انواع المكياج',
            'image' => '/public/store_image/image2.jpg',
        ]);

        Store::create([
            'name' => 'متجر هواتف',
            'description' => 'جميع انواع الهواتف',
            'image' => '/public/store_image/image3.jpg',
        ]);

        Store::create([
            'name' => 'متجر مفروشات',
            'description' => 'جميع انواع المفروشات',
            'image' => '/public/store_image/image4.jpg',
        ]);





        Product::create([
            'name' => 'كنزة ',
            'description' => 'جميع المقاسات',
            'amount' => 10,
            'price' => 100,
            'image' => '/public/product_image/product1.jpgp',
            'store_id' => 1,
        ]);

        Product::create([
            'name' => 'tyr ',
            'description' => 'جميع المقاسات',
            'amount' => 10,
            'price' => 100,
            'image' => '/public/product_image/product1.jpgp',
            'store_id' => 1,
        ]);


        Product::create([
            'name' => 'cs ',
            'description' => 'جميع المقاسات',
            'amount' => 10,
            'price' => 100,
            'image' => '/public/product_image/product1.jpgp',
            'store_id' => 2,
        ]);


        Product::create([
            'name' => 'fgbf ',
            'description' => 'جميع المقاسات',
            'amount' => 10,
            'price' => 100,
            'image' => '/public/product_image/product1.jpgp',
            'store_id' => 3,
        ]);



        Features::create([
            'text' => 'High Quality',
            'product_id' => 1,
        ]);

        Features::create([
            'text' => 'fast quality',
            'product_id' => 1,
        ]);

        Features::create([
            'text' => 'best quality',
            'product_id' => 2,
        ]);

        Features::create([
            'text' => 'good quality',
            'product_id' => 2,
        ]);


        Features::create([
            'text' => 'good quality',
            'product_id' => 3,
        ]);
    }
}
