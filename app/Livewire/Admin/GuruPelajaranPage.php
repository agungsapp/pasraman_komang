<?php

namespace App\Livewire\Admin;

use App\Models\GuruPelajaran;
use App\Models\Pelajaran;
use App\Models\User;
use App\Trait\LivewireAlertTrait;
use Livewire\Component;
use Livewire\WithPagination;

class GuruPelajaranPage extends Component
{
    use LivewireAlertTrait, WithPagination;

    public $guru_id = '';
    public $pelajaran_id = '';
    public $editMode = false;
    public $guruPelajaranId = null;
    public $modalDetails = null;

    protected function rules()
    {
        return [
            'guru_id' => 'required|exists:users,id,role,guru',
            'pelajaran_id' => [
                'required',
                'exists:pelajarans,id',
                'unique:guru_pelajarans,pelajaran_id,' . ($this->guruPelajaranId ?? 'NULL') . ',id,guru_id,' . ($this->guru_id ?? 'NULL'),
            ],
        ];
    }

    public function mount()
    {
        $this->resetInput();
    }

    public function render()
    {
        $gurus = User::where('role', 'guru')->get();
        $pelajarans = Pelajaran::where('is_active', true)->get();

        $guruPelajarans = GuruPelajaran::with(['guru', 'pelajaran'])
            ->orderBy('guru_id', 'desc')
            ->paginate(10);

        return view('livewire.admin.guru-pelajaran-page', [
            'guruPelajarans' => $guruPelajarans,
            'gurus' => $gurus,
            'pelajarans' => $pelajarans,
        ]);
    }

    public function updatedGuruId($value)
    {
        $this->resetInput('pelajaran_id');
    }

    public function store()
    {
        $this->validate();

        GuruPelajaran::create([
            'guru_id' => $this->guru_id,
            'pelajaran_id' => $this->pelajaran_id,
        ]);

        $this->resetInput();
        $this->alertSuccess('Berhasil', 'Data Guru Pelajaran berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $guruPelajaran = GuruPelajaran::findOrFail($id);
        $this->guruPelajaranId = $id;
        $this->guru_id = $guruPelajaran->guru_id;
        $this->pelajaran_id = $guruPelajaran->pelajaran_id;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $guruPelajaran = GuruPelajaran::findOrFail($this->guruPelajaranId);
        $guruPelajaran->update([
            'guru_id' => $this->guru_id,
            'pelajaran_id' => $this->pelajaran_id,
        ]);

        $this->resetInput();
        $this->alertSuccess('Berhasil', 'Data Guru Pelajaran berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function delete($id)
    {
        GuruPelajaran::findOrFail($id)->delete();
        $this->alertSuccess('Berhasil', 'Data Guru Pelajaran berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function confirmDelete($id)
    {
        $this->alertConfirm('Konfirmasi', 'Yakin ingin menghapus data ini?', [
            'onConfirmed' => ['delete', $id],
        ]);
    }

    public function detail($guru_id)
    {
        $this->guruPelajaranId = $guru_id;
        $allPelajarans = Pelajaran::where('is_active', true)->get();
        $guruPelajarans = GuruPelajaran::where('guru_id', $guru_id)->with('pelajaran')->get()->pluck('pelajaran_id')->toArray();
        $this->modalDetails = $allPelajarans->map(function ($pelajaran) use ($guruPelajarans) {
            return [
                'pelajaran' => $pelajaran,
                'isTaught' => in_array($pelajaran->id, $guruPelajarans),
            ];
        });
        $this->dispatch('open-modal', id: 'modalDetail');
    }

    public function cancelEdit()
    {
        $this->resetInput();
    }

    private function resetInput($field = null)
    {
        if ($field) {
            $this->$field = '';
        } else {
            $this->guru_id = '';
            $this->pelajaran_id = '';
            $this->editMode = false;
            $this->guruPelajaranId = null;
            $this->modalDetails = null;
            $this->resetErrorBag();
        }
    }
}
