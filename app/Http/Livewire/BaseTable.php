<?php
namespace App\Http\Livewire;

use Livewire\Component;

abstract class BaseTable extends Component
{
    public function applyTable($query)
    {
        return $query
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage)
            ->onEachSide(1);
    }
}
