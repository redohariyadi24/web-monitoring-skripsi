<?php

namespace App\Livewire;

use App\Models\Bimbingan;
use Livewire\Component;
use Livewire\WithPagination;

class TabelBimbingan extends Component
{
    public $search = '';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $bimbingans = Bimbingan::query()
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereHas('mahasiswa', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhere('npm', 'like', '%' . $this->search . '%');
                    })
                        ->orWhereHas('dosen', function ($q) {
                            $q->where('nama', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('skripsi', function ($q) {
                            $q->where('judul', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('bab', function ($q) {
                            $q->where('nama', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('subbab', function ($q) {
                            $q->where('nama', 'like', '%' . $this->search . '%');
                        })
                        ->orWhere('status', 'like', '%' . $this->search . '%');
                });
            })->paginate(10);
        return view('livewire.tabel-bimbingan', ['bimbingans' => $bimbingans]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
