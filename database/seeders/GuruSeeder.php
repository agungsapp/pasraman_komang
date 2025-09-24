<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // Data guru
        $gurus = [
            [
                'name' => 'I Made Oma Dharmawan, S.Pd',
                'email' => 'madeoma21@gmail.com',
                'password' => Hash::make('admin123'),
                'deskripsi' => 'Guru SD Kelas 1-3',

            ],
            [
                'name' => 'Desak Putu Rina Sari, S.Pd.H',
                'email' => 'desakputurinasari@gmail.com',
                'password' => Hash::make('admin123'),
                'deskripsi' => 'Guru SD Kelas 4-6',

            ],
            [
                'name' => 'Nengah Sumesari, S.Pd.H',
                'email' => 'sumesarinengah@gmail.com',
                'password' => Hash::make('admin123'),
                'deskripsi' => 'Guru SMP Kelas 1-3',

            ],
            [
                'name' => 'Dra. Ni Wayan Sarti, M.Si',
                'email' => 'miwayansarti@gmail.com',
                'password' => Hash::make('admin123'),
                'deskripsi' => 'Guru SMA Kelas 1-3',

            ],
            [
                'name' => 'Ketut Artaye, S.Kom.,M.T.I',
                'email' => 'ketutartaye@gmail.com',
                'password' => Hash::make('admin123'),
                'deskripsi' => 'Guru SMA Kelas 1-3',

            ],
        ];

        foreach ($gurus as $guru) {
            User::create($guru);
        }

        // Data staff
        $staffs = [
            [
                'name' => 'Staff 1',
                'email' => 'staff1@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'staff',
                'deskripsi' => null,

            ],
            [
                'name' => 'Staff 2',
                'email' => 'staff2@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'staff',
                'deskripsi' => null,

            ],
        ];

        foreach ($staffs as $staff) {
            User::create($staff);
        }
    }
}
