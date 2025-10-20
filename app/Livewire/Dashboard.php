<?php

namespace App\Livewire;

use App\Models\Rekap;
use Livewire\Component;

class Dashboard extends Component
{
    public $total_tahun;

    public $total_bulan;

    public $total_bulan_lalu;

    public $total_hari;

    public function mount()
    {
        $this->total_tahun = Rekap::total_tahun();
        $this->total_bulan = Rekap::total_bulan();
        $this->total_bulan_lalu = Rekap::total_bulan_lalu();
        $this->total_hari = Rekap::total_hari();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
