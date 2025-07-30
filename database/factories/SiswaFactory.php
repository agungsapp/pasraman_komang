<?php

namespace Database\Factories;

use App\Models\Jenjang;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenjang_id' => $this->faker->numberBetween(1, 3), // Random jenjang_id antara 1-3
            'kelas_id' => $this->faker->numberBetween(1, 5), // Random kelas_id antara 1-3
            'nama' => $this->faker->firstName() . ' ' . $this->faker->lastName(), // Nama tanpa gelar
            'nisn' => $this->faker->optional()->numerify('##########'), // NISN 10 digit, nullable
            'email' => $this->faker->unique()->safeEmail(), // Email unik
            'no_orang_tua' => $this->faker->phoneNumber(), // Nomor telepon
            'nama_orang_tua' => $this->faker->name(), // Nama orang tua (bisa dengan gelar)
            'alamat' => $this->faker->address(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-18 years', '-6 years')->format('Y-m-d'), // Umur siswa (6-18 tahun)
            'tempat_lahir' => $this->faker->city(), // Tempat lahir
            'password' => Hash::make('siswa123'), // Password default
            'is_active' => true, // Akun aktif untuk login
        ];
    }
}
