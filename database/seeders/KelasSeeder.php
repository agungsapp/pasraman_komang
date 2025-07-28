<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $items = [
        //     [
        //         'nama' => 'ps'
        //     ],
        // ];
        for ($i = 0; $i < 5; $i++) {
            Kelas::create([
                'nama' => 'ps' . $i + 1,
            ]);
        }
    }
}
