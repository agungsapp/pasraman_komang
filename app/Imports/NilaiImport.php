<?php

namespace App\Imports;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Pelajaran;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NilaiImport implements ToCollection, WithHeadingRow, WithValidation
{
    public $errors = [];

    public function collection(Collection $rows)
    {
        // Validasi semua baris terlebih dahulu
        $dataToImport = [];
        $rowIndex = 2; // Mulai dari baris 2 (setelah header)

        foreach ($rows as $row) {
            $error = $this->validateRow($row, $rowIndex);
            if ($error) {
                $this->errors[] = $error;
            } else {
                $dataToImport[] = $this->mapRowToData($row);
            }
            $rowIndex++;
        }

        // Jika ada error, batalkan import
        if (!empty($this->errors)) {
            return;
        }

        // Simpan semua data dalam transaksi
        DB::transaction(function () use ($dataToImport) {
            foreach ($dataToImport as $data) {
                Nilai::create($data);
            }
        });
    }

    protected function validateRow($row, $rowIndex)
    {
        // Validasi siswa
        $siswa = $this->findSiswa($row['siswa']);
        if (!$siswa) {
            return "Baris {$rowIndex}: Siswa '{$row['siswa']}' tidak ditemukan.";
        }
        if (is_array($siswa)) {
            return "Baris {$rowIndex}: Nama siswa '{$row['siswa']}' ambigu, ditemukan lebih dari satu siswa: " . implode(', ', $siswa);
        }

        // Validasi pelajaran
        $pelajaran = $this->findPelajaran($row['pelajaran']);
        if (!$pelajaran) {
            return "Baris {$rowIndex}: Pelajaran '{$row['pelajaran']}' tidak ditemukan.";
        }
        if (is_array($pelajaran)) {
            return "Baris {$rowIndex}: Nama pelajaran '{$row['pelajaran']}' ambigu, ditemukan lebih dari satu pelajaran: " . implode(', ', $pelajaran);
        }

        // Validasi guru
        $guru = $this->findGuru($row['guru']);
        if (!$guru) {
            return "Baris {$rowIndex}: Guru '{$row['guru']}' tidak ditemukan.";
        }
        if (is_array($guru)) {
            return "Baris {$rowIndex}: Nama guru '{$row['guru']}' ambigu, ditemukan lebih dari satu guru: " . implode(', ', $guru);
        }

        // Validasi hubungan guru-pelajaran
        $guruPelajaran = $guru->pelajarans()->where('pelajaran_id', $pelajaran->id)->exists();
        if (!$guruPelajaran) {
            return "Baris {$rowIndex}: Guru '{$row['guru']}' tidak mengajar pelajaran '{$row['pelajaran']}'.";
        }

        // Validasi nilai
        if (!is_numeric($row['nilai']) || $row['nilai'] < 0 || $row['nilai'] > 100) {
            return "Baris {$rowIndex}: Nilai '{$row['nilai']}' tidak valid, harus antara 0 dan 100.";
        }

        // Validasi keterangan
        if (isset($row['keterangan']) && strlen($row['keterangan']) > 255) {
            return "Baris {$rowIndex}: Keterangan terlalu panjang, maksimum 255 karakter.";
        }

        // Cek duplikasi nilai
        $existingNilai = Nilai::where('siswa_id', $siswa->id)
            ->where('pelajaran_id', $pelajaran->id)
            ->where('guru_id', $guru->id)
            ->first();
        if ($existingNilai) {
            return "Baris {$rowIndex}: Nilai sudah ada untuk siswa '{$row['siswa']}', pelajaran '{$row['pelajaran']}', dan guru '{$row['guru']}'.";
        }

        return null;
    }

    protected function mapRowToData($row)
    {
        $siswa = $this->findSiswa($row['siswa']);
        $pelajaran = $this->findPelajaran($row['pelajaran']);
        $guru = $this->findGuru($row['guru']);

        return [
            'siswa_id' => $siswa->id,
            'pelajaran_id' => $pelajaran->id,
            'guru_id' => $guru->id,
            'nilai' => $row['nilai'],
            'keterangan' => $row['keterangan'] ?? null,
        ];
    }

    protected function findSiswa($input)
    {
        if (is_numeric($input)) {
            return Siswa::find($input);
        }

        $siswas = Siswa::where('nama', 'like', '%' . $input . '%')->get();
        if ($siswas->count() === 1) {
            return $siswas->first();
        }
        if ($siswas->count() > 1) {
            return $siswas->pluck('nama')->toArray();
        }
        return null;
    }

    protected function findPelajaran($input)
    {
        if (is_numeric($input)) {
            return Pelajaran::find($input);
        }

        $pelajarans = Pelajaran::where('nama_pelajaran', 'like', '%' . $input . '%')->get();
        if ($pelajarans->count() === 1) {
            return $pelajarans->first();
        }
        if ($pelajarans->count() > 1) {
            return $pelajarans->pluck('nama_pelajaran')->toArray();
        }
        return null;
    }

    protected function findGuru($input)
    {
        if (is_numeric($input)) {
            return User::where('role', 'guru')->find($input);
        }

        $gurus = User::where('role', 'guru')->where('name', 'like', '%' . $input . '%')->get();
        if ($gurus->count() === 1) {
            return $gurus->first();
        }
        if ($gurus->count() > 1) {
            return $gurus->pluck('name')->toArray();
        }
        return null;
    }

    public function rules(): array
    {
        return [
            'siswa' => 'required|string',
            'pelajaran' => 'required|string',
            'guru' => 'required|string',
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string|max:255',
        ];
    }
}
