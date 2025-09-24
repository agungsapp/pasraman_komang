<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $path = public_path('seeder/siswa.csv');

        if (!File::exists($path)) {
            $this->command->error("❌ File siswa.csv tidak ditemukan di: $path");
            return;
        }

        // Gunakan ; sebagai pemisah
        $csv = array_map(function ($line) {
            return str_getcsv($line, ';');
        }, file($path));

        $header = array_map('trim', array_shift($csv)); // Ambil header

        $skipCount = 0;
        $skipRows = [];
        $successCount = 0;

        foreach ($csv as $index => $row) {
            $barisExcel = $index + 2; // +2 karena header + array mulai dari 0

            if (count($row) !== count($header)) {
                $skipCount++;
                $skipRows[] = $barisExcel;
                continue;
            }

            $data = array_combine($header, $row);

            try {
                \App\Models\Siswa::create([
                    'jenjang_id' => (int) $data['jenjang_id'],
                    'kelas_id' => (int) $data['kelas_id'],
                    'nama' => $data['nama'],
                    'nisn' => $data['nisn'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tanggal_lahir' => \Carbon\Carbon::parse($data['tanggal_lahir']),
                    'email' => $data['email'],
                    'alamat' => $data['alamat'],
                    'no_orang_tua' => $data['no_orang_tua'],
                    'nama_orang_tua' => $data['nama_orang_tua'],
                    'password' => Hash::make($data['password']),
                    'is_active' => filter_var($data['is_active'], FILTER_VALIDATE_BOOLEAN),
                ]);

                $successCount++;
            } catch (\Throwable $e) {
                $skipCount++;
                $skipRows[] = $barisExcel;
                continue;
            }
        }

        $this->command->info("✅ Import selesai.");
        $this->command->info("✔️ Berhasil: $successCount");
        $this->command->warn("⚠️  Dilewati: $skipCount baris");
        if (!empty($skipRows)) {
            $this->command->warn("📌 Baris yang di-skip: " . implode(', ', $skipRows));
        }
    }
}
