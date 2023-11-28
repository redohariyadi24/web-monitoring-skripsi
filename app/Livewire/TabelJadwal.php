<?php

namespace App\Livewire;

use App\Models\Jadwal;
use Livewire\Component;
use Livewire\WithPagination;

class TabelJadwal extends Component
{
    public $search = '';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $jadwals = Jadwal::with(['skripsi.mahasiswa', 'skripsi.dosen1', 'skripsi.dosen2'])
        ->where(function ($query) {
            $query->whereHas('skripsi.mahasiswa', function ($subquery) {
                $subquery->where('nama', 'like', '%' . $this->search . '%');
            })
                ->orWhereHas('skripsi', function ($subquery) {
                    $subquery->where('judul', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('skripsi.dosen1', function ($subquery) {
                    $subquery->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('skripsi.dosen2', function ($subquery) {
                    $subquery->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhere('tanggal', 'like', '%' . $this->search . '%');
        })
            ->paginate(10);

        return view('livewire.tabel-jadwal', ['jadwals' => $jadwals]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
