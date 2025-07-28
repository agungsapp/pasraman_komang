<?php

namespace Database\Seeders;

use App\Models\BiayaPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiayaPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'jenjang_id' => 1,
                'komponen_biaya_id' => 1,
                'nominal' => 25000,
            ],
            [
                'jenjang_id' => 1,
                'komponen_biaya_id' => 2,
                'nominal' => 20000,
            ],
            [
                'jenjang_id' => 1,
                'komponen_biaya_id' => 3,
                'nominal' => 50000,
            ],
            [
                'jenjang_id' => 2,
                'komponen_biaya_id' => 1,
                'nominal' => 50000,
            ],
            [
                'jenjang_id' => 2,
                'komponen_biaya_id' => 2,
                'nominal' => 25000,
            ],
            [
                'jenjang_id' => 2,
                'komponen_biaya_id' => 3,
                'nominal' => 75000,
            ],
            [
                'jenjang_id' => 3,
                'komponen_biaya_id' => 1,
                'nominal' => 75000,
            ],
            [
                'jenjang_id' => 3,
                'komponen_biaya_id' => 2,
                'nominal' => 75000,
            ],
            [
                'jenjang_id' => 3,
                'komponen_biaya_id' => 3,
                'nominal' => 75000,
            ],
        ];


        foreach ($items as $item) {
            BiayaPendidikan::create($item);
        }
    }
}
