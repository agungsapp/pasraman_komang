<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Trait\LivewireAlertTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GuruPage extends Component
{
    use LivewireAlertTrait;

    public $name = '';
    public $email = '';
    public $password = '';
    public $editMode = false;
    public $guruId = null;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email' . ($this->editMode ? ',' . $this->guruId : ''),
            'password' => $this->editMode ? 'nullable|string|min:8' : 'required|string|min:8',

        ];
    }

    public function render()
    {
        return view('livewire.admin.guru-page', [
            'gurus' => User::where('role', 'guru')->get(),
        ]);
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'guru',
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Guru berhasil ditambahkan!');
        $this->dispatch('reload-table');
    }

    public function edit($id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);
        $this->guruId = $id;
        $this->name = $guru->name;
        $this->email = $guru->email;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $guru = User::where('role', 'guru')->findOrFail($this->guruId);
        $guru->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $guru->password,
        ]);

        $this->resetForm();
        $this->alertSuccess('Berhasil', 'Guru berhasil diperbarui!');
        $this->dispatch('reload-table');
    }

    public function delete($id)
    {
        User::where('role', 'guru')->findOrFail($id)->delete();
        $this->alertSuccess('Berhasil', 'Guru berhasil dihapus!');
        $this->dispatch('reload-table');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->editMode = false;
        $this->guruId = null;
        $this->resetErrorBag();
    }
}
