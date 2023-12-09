<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TabelAkunDosen extends Component
{
    public $search = '';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $dosen = User::where('role', 'dosen')
        ->when($this->search, function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%');
            });
        })
            ->paginate(10);

        return view('livewire.tabel-akun-dosen', ['dosen' => $dosen]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
}
