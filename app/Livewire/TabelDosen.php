<?php

namespace App\Livewire;

use App\Models\Dosen;
use Livewire\Component;
use Livewire\WithPagination;

class TabelDosen extends Component
{
    public $search = '';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $dosens = Dosen::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('nip', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.tabel-dosen', ['dosens' => $dosens]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
