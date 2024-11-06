<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        // Eliminar y crear la carpeta para las imágenes
        Storage::deleteDirectory('public/shop');
        Storage::makeDirectory('public/shop');

        Shop::factory(1)->create()->each(function(Shop $shop){
            $faker = Faker::create();
            // $shop->image()->create(['url'=>'shop/'.$faker->image('public/storage/shop',640,480,'Shop',false)]);

            $shop->image()->create(['url'=>'shop/'.$faker->image('public/storage/shop',640,480,'Product',false)]);
            
        });
    }
}

