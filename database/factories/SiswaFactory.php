<?php

namespace Database\Factories;

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
            'jenjang_id'     => 1, // atau sesuaikan
            'kelas_id' => $this->faker->numberBetween(1, 5),
            'nama'           => $this->faker->name(),
            'email'            => $this->faker->email(),
            'no_orang_tua'   => $this->faker->phoneNumber(),
            'alamat'         => $this->faker->address(),
            'tanggal_lahir'  => $this->faker->date(),
            'password'       => Hash::make('siswa123'), // password disamakan
            'is_active'      => true,
        ];
    }
}
