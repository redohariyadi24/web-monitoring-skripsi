<?php

namespace App\Livewire;

use App\Models\Mahasiswa;
use Livewire\Component;
use Livewire\WithPagination;

class TabelMahasiswa extends Component
{
    public $search = '';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $mahasiswas = Mahasiswa::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('npm', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.tabel-mahasiswa', ['mahasiswas' => $mahasiswas]);
    }

    public function updatingSearch()
    {
    $this->resetPage();
    }
}
