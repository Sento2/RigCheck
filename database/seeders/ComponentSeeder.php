<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        Component::create([
            'name' => 'Intel Core i5-13400F',
            'category' => 'cpu',
            'price' => 3100000,
            'wattage' => 65,
            'spesifikasi' => ['socket' => 'LGA1700', 'cores' => 10]
        ]);

        Component::create([
            'name' => 'AMD Ryzen 5 7600X',
            'category' => 'cpu',
            'price' => 3800000,
            'wattage' => 105,
            'spesifikasi' => ['socket' => 'AM5', 'cores' => 6]
        ]);

        Component::create([
            'name' => 'Nvidia RTX 4060 Ti 8GB',
            'category' => 'gpu',
            'price' => 6500000,
            'wattage' => 160,
            'spesifikasi' => ['vram' => '8GB', 'type' => 'GDDR6']
        ]);

        Component::create([
            'name' => 'ASUS Prime B760M-A',
            'category' => 'motherboard',
            'price' => 2200000,
            'wattage' => 0,
            'spesifikasi' => ['socket' => 'LGA1700', 'chipset' => 'B760']
        ]);

        Component::create([
            'name' => 'Kingston FURY Beast DDR5 16GB',
            'category' => 'ram',
            'price' => 950000,
            'wattage' => 5,
            'spesifikasi' => ['speed' => '5200MHz', 'type' => 'DDR5']
        ]);
    }
}