<?php


namespace App\Http\Livewire\Traits;

use Livewire\WithPagination;

trait WithCustomPagination
{
    use WithPagination;

    public function paginationView()
    {
        return "livewire.pagination.bulma";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTerverifikasi()
    {
        $this->resetPage();
    }
}