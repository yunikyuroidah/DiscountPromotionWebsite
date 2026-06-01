<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->delete();

        Admin::create([
            'name' => 'Admin Utama',
            'email' => 'admin@promo.local',
            'password' => Hash::make('admin123'),
        ]);

        Admin::create([
            'name' => 'Admin Konten',
            'email' => 'konten@promo.local',
            'password' => Hash::make('admin123'),
        ]);
    }
}
