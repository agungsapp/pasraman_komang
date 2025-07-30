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

        Siswa::create([
            'jenjang_id'     => 1,
            'kelas_id' => 1,
            'nama'           => 'agung saputra',
            'email'            => 'agung.dni19@gmail.com',
            'no_orang_tua'   => '085855558888',
            'alamat'         => 'Jl. pramuka bedera',
            'tanggal_lahir'  => '11/08/2010',
            'password'       => Hash::make('siswa123'),
            'is_active'      => true,
        ]);

        Siswa::factory()->count(50)->create();
        Pelajaran::factory()->count(10)->create();
        $this->call(KomponenBiayaSeeder::class);
        $this->call(BiayaPendidikanSeeder::class);
    }
}
