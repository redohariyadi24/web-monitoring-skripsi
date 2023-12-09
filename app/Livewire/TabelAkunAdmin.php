<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TabelAkunAdmin extends Component
{
    public $search = '';

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $admin = User::where('role', 'admin')
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('username', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate(10);

        return view('livewire.tabel-akun-admin', ['admin' => $admin]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
