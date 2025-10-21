<?php

namespace App\Livewire\Encounter;

use Livewire\Component;

class EncounterCreate extends Component
{
    public $encounter_date;

    public function mount()
    {
        $this->encounter_date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.encounter.encounter-create');
    }
}
