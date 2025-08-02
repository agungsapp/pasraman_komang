<?php

namespace App\Livewire\Admin;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Pelajaran;
use App\Models\User;
use App\Imports\NilaiImport;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Trait\LivewireAlertTrait;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\Layout;


class AdminNilaiPage extends Component
{
    use WithPagination, WithFileUploads, LivewireAlertTrait;

    public $siswa_id, $pelajaran_id, $guru_id, $nilai, $keterangan;
    public $editId = null;
    public $search = '';
    public $perPage = 10;
    public $file;
    public $importErrors = [];

    protected $rules = [
        'siswa_id' => 'required|exists:siswas,id',
        'pelajaran_id' => 'required|exists:pelajarans,id',
        'guru_id' => 'required|exists:users,id',
        'nilai' => 'required|numeric|min:0|max:100',
        'keterangan' => 'nullable|string|max:255',
        'file' => 'required|mimes:xlsx,xls|max:2048',
    ];

    public function resetForm()
    {
        $this->siswa_id = null;
        $this->pelajaran_id = null;
        $this->guru_id = null;
        $this->nilai = null;
        $this->keterangan = null;
        $this->file = null;
        $this->editId = null;
        $this->importErrors = [];
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'guru_id' => 'required|exists:users,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $guru = User::find($this->guru_id);
        $guruPelajaran = $guru->pelajarans()->where('pelajaran_id', $this->pelajaran_id)->exists();
        if (!$guruPelajaran) {
            $this->alertError('guru_id', 'Guru ini tidak mengajar pelajaran yang dipilih.');
            return;
        }

        $existingNilai = Nilai::where('siswa_id', $this->siswa_id)
            ->where('pelajaran_id', $this->pelajaran_id)
            ->where('guru_id', $this->guru_id)
            ->first();
        if ($existingNilai) {
            $this->alertError('nilai', 'Nilai untuk kombinasi siswa, pelajaran, dan guru ini sudah ada.');
            return;
        }

        Nilai::create([
            'siswa_id' => $this->siswa_id,
            'pelajaran_id' => $this->pelajaran_id,
            'guru_id' => $this->guru_id,
            'nilai' => $this->nilai,
            'keterangan' => $this->keterangan,
        ]);

        $this->alertSuccess('Nilai berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $nilai = Nilai::find($id);
        if ($nilai) {
            $this->editId = $id;
            $this->siswa_id = $nilai->siswa_id;
            $this->pelajaran_id = $nilai->pelajaran_id;
            $this->guru_id = $nilai->guru_id;
            $this->nilai = $nilai->nilai;
            $this->keterangan = $nilai->keterangan;
        }
    }

    public function update()
    {
        $this->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'guru_id' => 'required|exists:users,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $nilai = Nilai::find($this->editId);
        if ($nilai) {
            $guru = User::find($this->guru_id);
            $guruPelajaran = $guru->pelajarans()->where('pelajaran_id', $this->pelajaran_id)->exists();
            if (!$guruPelajaran) {
                $this->alertError('guru_id', 'Guru ini tidak mengajar pelajaran yang dipilih.');
                return;
            }

            $nilai->update([
                'siswa_id' => $this->siswa_id,
                'pelajaran_id' => $this->pelajaran_id,
                'guru_id' => $this->guru_id,
                'nilai' => $this->nilai,
                'keterangan' => $this->keterangan,
            ]);

            $this->alertSuccess('Nilai berhasil diperbarui.');
            $this->resetForm();
        }
    }

    public function delete($id)
    {
        $nilai = Nilai::find($id);
        if ($nilai) {
            $nilai->delete();
            $this->alertSuccess('Nilai berhasil dihapus.');
        }
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            $import = new NilaiImport();
            Excel::import($import, $this->file);
            $this->importErrors = $import->errors;

            if (!empty($this->importErrors)) {
                $this->alertError('file', 'Gagal mengimpor data. Periksa log error di bawah.');
                return;
            }

            $this->alertSuccess('Data nilai berhasil diimpor.');
            $this->resetForm();
        } catch (\Exception $e) {
            $this->alertError('file', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $nilais = Nilai::with(['siswa', 'pelajaran', 'guru'])
            ->where(function ($query) {
                $query->whereHas('siswa', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('pelajaran', function ($q) {
                        $q->where('nama_pelajaran', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('guru', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->paginate($this->perPage);

        $siswas = Siswa::where('is_active', 1)->get();
        $pelajarans = Pelajaran::where('is_active', 1)->get();
        $gurus = User::guru()->get();

        return view('livewire.admin.admin-nilai-page', [
            'nilais' => $nilais,
            'siswas' => $siswas,
            'pelajarans' => $pelajarans,
            'gurus' => $gurus,
        ]);
    }
}
