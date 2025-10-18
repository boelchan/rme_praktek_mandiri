<?php

namespace App\Livewire\Penerima;

use App\Models\Penerima;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PenerimaCreate extends Component
{
    #[Validate('required')]
    public $nama;

    #[Validate('required|unique:penerimas,nomor_rekening')]
    public $nomor_rekening;

    #[Validate('required')]
    public $alamat;

    public function store()
    {
        $this->validate();

        Penerima::create([
            'nama' => $this->nama,
            'nomor_rekening' => $this->nomor_rekening,
            'alamat' => $this->alamat,
        ]);

        Toaster::success('Data berhasil disimpan.');

        return to_route('penerima.index');
    }

    public function render()
    {
        return view('livewire.penerima.penerima-create');
    }
}
