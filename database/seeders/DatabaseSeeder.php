<?php

namespace Database\Seeders;

use App\Models\Jenjang;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin Pasraman',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);
        User::factory(5)->create();

        $jenjangs = [
            ['nama' => 'SD'],
            ['nama' => 'SMP'],
            ['nama' => 'SMA'],
        ];

        foreach ($jenjangs as $jenjang) {
            Jenjang::create($jenjang);
        }

        $this->call(KelasSeeder::class);
        Siswa::factory()->count(50)->create();
        Pelajaran::factory()->count(10)->create();
        $this->call(KomponenBiayaSeeder::class);
        $this->call(BiayaPendidikanSeeder::class);
    }
}
