<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelajaran>
 */
class PelajaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pelajaran' => $this->faker->randomElement([
                'Agama Hindu',
                'Tattwa (Filsafat Hindu)',
                'Susila (Etika Hindu)',
                'Upacara Hindu (Acara Keagamaan)',
                'Kewajiban Umat Hindu (Tri Kaya Parisudha, Catur Guru, dll)',
                'Aksara Bali',
                'Bahasa Sanskerta Dasar',
                'Kesenian Hindu (Tari, Gamelan, dll)',
                'Yoga dan Meditasi',
                'Pendidikan Karakter Hindu'
            ]),
            'tahun_ajaran'   => $this->faker->randomElement(['2024/2025', '2025/2026']),
            'is_active'      => $this->faker->boolean(90), // 90% aktif
        ];
    }
}
