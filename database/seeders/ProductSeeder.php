<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->delete();

        $items = [
            [
                'name' => 'Roco Wireless Headphone',
                'brand' => 'Roco',
                'category' => 'Audio',
                'weight_grams' => 320,
                'price' => 589000,
                'discount_percent' => 20,
                'discount_valid_until' => Carbon::now()->addDays(30),
                'description' => 'Headphone nirkabel dengan bass tebal dan baterai tahan lama.',
            ],
            [
                'name' => 'Power Bank 10000mAh',
                'brand' => 'Voltix',
                'category' => 'Power',
                'weight_grams' => 240,
                'price' => 179000,
                'discount_percent' => 15,
                'discount_valid_until' => Carbon::now()->addDays(20),
                'description' => 'Pengisian cepat 2 port untuk mobilitas harian.',
            ],
            [
                'name' => 'Smartwatch Sporty X1',
                'brand' => 'Pulse',
                'category' => 'Wearable',
                'weight_grams' => 90,
                'price' => 459000,
                'discount_percent' => 25,
                'discount_valid_until' => Carbon::now()->addDays(25),
                'description' => 'Pantau aktivitas, notifikasi, dan mode olahraga.',
            ],
            [
                'name' => 'Blender Portable Mini',
                'brand' => 'BlendGo',
                'category' => 'Kitchen',
                'weight_grams' => 560,
                'price' => 329000,
                'discount_percent' => 10,
                'discount_valid_until' => Carbon::now()->addDays(14),
                'description' => 'Blender isi ulang untuk smoothie praktis.',
            ],
            [
                'name' => 'Jam Tangan Kasual Pro',
                'brand' => 'Chrona',
                'category' => 'Wearable',
                'weight_grams' => 110,
                'price' => 399000,
                'discount_percent' => 0,
                'discount_valid_until' => Carbon::now()->addDays(5),
                'description' => 'Desain minimalis untuk gaya profesional.',
            ],
            [
                'name' => 'Tas Ransel Laptop 15 inci',
                'brand' => 'UrbanPack',
                'category' => 'Aksesori',
                'weight_grams' => 780,
                'price' => 279000,
                'discount_percent' => 12,
                'discount_valid_until' => Carbon::now()->addDays(12),
                'description' => 'Kompartemen aman dan bahan tahan air.',
            ],
            [
                'name' => 'Mug Tumbler Stainless',
                'brand' => 'Thermo',
                'category' => 'Aksesori',
                'weight_grams' => 350,
                'price' => 149000,
                'discount_percent' => 18,
                'discount_valid_until' => Carbon::now()->addDays(8),
                'description' => 'Menjaga suhu minuman lebih lama.',
            ],
            [
                'name' => 'Kacamata Sunglasses Polarized',
                'brand' => 'Rayla',
                'category' => 'Aksesori',
                'weight_grams' => 60,
                'price' => 219000,
                'discount_percent' => 30,
                'discount_valid_until' => Carbon::now()->addDays(18),
                'description' => 'Lensa polarized untuk aktivitas luar ruang.',
            ],
        ];

        foreach ($items as $item) {
            Product::create($item);
        }
    }
}
