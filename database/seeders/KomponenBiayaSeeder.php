<?php

namespace Database\Seeders;

use App\Models\KomponenBiaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomponenBiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['nama' => 'Administrasi'],
            ['nama' => 'SPP/Bulan'],
            ['nama' => 'Bangunan'],
        ];

        foreach ($items as $item) {
            KomponenBiaya::create($item);
        }
    }
}
