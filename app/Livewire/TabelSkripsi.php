<?php

namespace App\Livewire;

use App\Models\Skripsi;
use Livewire\Component;
use Livewire\WithPagination;

class TabelSkripsi extends Component
{
    public $search = '';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $skripsis = Skripsi::where('judul', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.tabel-skripsi', ['skripsis' => $skripsis]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
