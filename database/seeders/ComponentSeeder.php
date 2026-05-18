<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        $components = [
            // CPUs (2020 - Present)
            ['name' => 'Intel Core i5-12400F', 'category' => 'cpu', 'price' => 2200000, 'wattage' => 65, 'spesifikasi' => ['socket' => 'LGA1700', 'cores' => 6]],
            ['name' => 'Intel Core i5-13400F', 'category' => 'cpu', 'price' => 3100000, 'wattage' => 65, 'spesifikasi' => ['socket' => 'LGA1700', 'cores' => 10]],
            ['name' => 'Intel Core i7-13700K', 'category' => 'cpu', 'price' => 6500000, 'wattage' => 125, 'spesifikasi' => ['socket' => 'LGA1700', 'cores' => 16]],
            ['name' => 'Intel Core i9-14900K', 'category' => 'cpu', 'price' => 10500000, 'wattage' => 125, 'spesifikasi' => ['socket' => 'LGA1700', 'cores' => 24]],
            
            ['name' => 'AMD Ryzen 5 5600X', 'category' => 'cpu', 'price' => 2400000, 'wattage' => 65, 'spesifikasi' => ['socket' => 'AM4', 'cores' => 6]],
            ['name' => 'AMD Ryzen 7 5800X3D', 'category' => 'cpu', 'price' => 5200000, 'wattage' => 105, 'spesifikasi' => ['socket' => 'AM4', 'cores' => 8]],
            ['name' => 'AMD Ryzen 5 7600X', 'category' => 'cpu', 'price' => 3800000, 'wattage' => 105, 'spesifikasi' => ['socket' => 'AM5', 'cores' => 6]],
            ['name' => 'AMD Ryzen 7 7800X3D', 'category' => 'cpu', 'price' => 6900000, 'wattage' => 120, 'spesifikasi' => ['socket' => 'AM5', 'cores' => 8]],

            // GPUs (2020 - Present)
            ['name' => 'Nvidia RTX 3060 12GB', 'category' => 'gpu', 'price' => 4500000, 'wattage' => 170, 'spesifikasi' => ['vram' => '12GB', 'type' => 'GDDR6']],
            ['name' => 'Nvidia RTX 3070 8GB', 'category' => 'gpu', 'price' => 6500000, 'wattage' => 220, 'spesifikasi' => ['vram' => '8GB', 'type' => 'GDDR6']],
            ['name' => 'Nvidia RTX 4060 8GB', 'category' => 'gpu', 'price' => 5200000, 'wattage' => 115, 'spesifikasi' => ['vram' => '8GB', 'type' => 'GDDR6']],
            ['name' => 'Nvidia RTX 4060 Ti 8GB', 'category' => 'gpu', 'price' => 6800000, 'wattage' => 160, 'spesifikasi' => ['vram' => '8GB', 'type' => 'GDDR6']],
            ['name' => 'Nvidia RTX 4070 Super 12GB', 'category' => 'gpu', 'price' => 10500000, 'wattage' => 220, 'spesifikasi' => ['vram' => '12GB', 'type' => 'GDDR6X']],
            ['name' => 'Nvidia RTX 4090 24GB', 'category' => 'gpu', 'price' => 35000000, 'wattage' => 450, 'spesifikasi' => ['vram' => '24GB', 'type' => 'GDDR6X']],
            
            ['name' => 'AMD Radeon RX 6600 8GB', 'category' => 'gpu', 'price' => 3200000, 'wattage' => 132, 'spesifikasi' => ['vram' => '8GB', 'type' => 'GDDR6']],
            ['name' => 'AMD Radeon RX 6700 XT 12GB', 'category' => 'gpu', 'price' => 5500000, 'wattage' => 230, 'spesifikasi' => ['vram' => '12GB', 'type' => 'GDDR6']],
            ['name' => 'AMD Radeon RX 7800 XT 16GB', 'category' => 'gpu', 'price' => 8900000, 'wattage' => 263, 'spesifikasi' => ['vram' => '16GB', 'type' => 'GDDR6']],

            // Motherboards
            ['name' => 'ASUS Prime B550M-A', 'category' => 'motherboard', 'price' => 1800000, 'wattage' => 0, 'spesifikasi' => ['socket' => 'AM4', 'chipset' => 'B550']],
            ['name' => 'MSI MAG B650 TOMAHAWK WIFI', 'category' => 'motherboard', 'price' => 3500000, 'wattage' => 0, 'spesifikasi' => ['socket' => 'AM5', 'chipset' => 'B650']],
            ['name' => 'Gigabyte B760M DS3H', 'category' => 'motherboard', 'price' => 1900000, 'wattage' => 0, 'spesifikasi' => ['socket' => 'LGA1700', 'chipset' => 'B760']],
            ['name' => 'ASUS ROG Strix Z790-F Gaming', 'category' => 'motherboard', 'price' => 6500000, 'wattage' => 0, 'spesifikasi' => ['socket' => 'LGA1700', 'chipset' => 'Z790']],

            // RAM
            ['name' => 'Corsair Vengeance LPX 16GB (2x8GB) DDR4', 'category' => 'ram', 'price' => 850000, 'wattage' => 5, 'spesifikasi' => ['speed' => '3200MHz', 'type' => 'DDR4']],
            ['name' => 'Kingston FURY Beast 32GB (2x16GB) DDR4', 'category' => 'ram', 'price' => 1350000, 'wattage' => 10, 'spesifikasi' => ['speed' => '3200MHz', 'type' => 'DDR4']],
            ['name' => 'Kingston FURY Beast 16GB (2x8GB) DDR5', 'category' => 'ram', 'price' => 1100000, 'wattage' => 5, 'spesifikasi' => ['speed' => '5200MHz', 'type' => 'DDR5']],
            ['name' => 'G.Skill Trident Z5 RGB 32GB (2x16GB) DDR5', 'category' => 'ram', 'price' => 2100000, 'wattage' => 10, 'spesifikasi' => ['speed' => '6000MHz', 'type' => 'DDR5']],

            // Storage
            ['name' => 'Kingston NV2 1TB M.2 NVMe', 'category' => 'storage', 'price' => 850000, 'wattage' => 5, 'spesifikasi' => ['capacity' => '1TB', 'type' => 'Gen4 NVMe']],
            ['name' => 'Samsung 980 Pro 1TB M.2 NVMe', 'category' => 'storage', 'price' => 1500000, 'wattage' => 5, 'spesifikasi' => ['capacity' => '1TB', 'type' => 'Gen4 NVMe']],
            ['name' => 'Samsung 990 Pro 2TB M.2 NVMe', 'category' => 'storage', 'price' => 2900000, 'wattage' => 5, 'spesifikasi' => ['capacity' => '2TB', 'type' => 'Gen4 NVMe']],
            ['name' => 'Crucial P3 500GB M.2 NVMe', 'category' => 'storage', 'price' => 550000, 'wattage' => 5, 'spesifikasi' => ['capacity' => '500GB', 'type' => 'Gen3 NVMe']],
            ['name' => 'Seagate Barracuda 2TB HDD', 'category' => 'storage', 'price' => 800000, 'wattage' => 15, 'spesifikasi' => ['capacity' => '2TB', 'type' => 'SATA HDD']],

            // PSU
            ['name' => 'Corsair CV650 650W 80+ Bronze', 'category' => 'psu', 'price' => 950000, 'wattage' => 0, 'spesifikasi' => ['rating' => '80+ Bronze', 'capacity' => '650W']],
            ['name' => 'Cooler Master MWE 750W 80+ Gold', 'category' => 'psu', 'price' => 1500000, 'wattage' => 0, 'spesifikasi' => ['rating' => '80+ Gold', 'capacity' => '750W']],
            ['name' => 'Corsair RM850e 850W 80+ Gold', 'category' => 'psu', 'price' => 2100000, 'wattage' => 0, 'spesifikasi' => ['rating' => '80+ Gold', 'capacity' => '850W']],
            ['name' => 'Seasonic Focus GX-1000 1000W 80+ Gold', 'category' => 'psu', 'price' => 3100000, 'wattage' => 0, 'spesifikasi' => ['rating' => '80+ Gold', 'capacity' => '1000W']],

            // Base Systems / Barebones
            ['name' => 'MSI Bravo 15 B5DD', 'category' => 'base_system', 'price' => 12000000, 'wattage' => 150, 'spesifikasi' => ['cpu_socket' => 'FP6 (Soldered)', 'ram_type' => 'DDR4', 'ram_slots' => 2, 'storage_slots' => ['M.2 NVMe Gen3']]],
            ['name' => 'ASUS ROG Zephyrus G14 (Barebone)', 'category' => 'base_system', 'price' => 18000000, 'wattage' => 200, 'spesifikasi' => ['cpu_socket' => 'FP7', 'ram_type' => 'DDR5', 'ram_slots' => 1, 'storage_slots' => ['M.2 NVMe Gen4']]],
        ];

        foreach ($components as $component) {
            // Use updateOrCreate to avoid duplicates if run multiple times
            Component::updateOrCreate(
                ['name' => $component['name']],
                $component
            );
        }
    }
}