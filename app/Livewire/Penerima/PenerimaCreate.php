<?php

namespace App\Livewire\Penerima;

use App\Models\Penerima;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PenerimaCreate extends Component
{
    #[Validate('required|unique:patients,nik')]
    public $nik;

    public $no_rm;

    #[Validate('required')]
    public $full_name;

    #[Validate('required')]
    public $gender;

    #[Validate('required')]
    public $address;

    #[Validate('required|date')]
    public $dob;


    public function store()
    {
        $this->validate();

        Penerima::create([
            'nik' => $this->nik,
            'no_rm' => $this->no_rm,
            'full_name' => $this->full_name,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'address' => $this->address,
        ]);

        Toaster::success('Data berhasil disimpan.');

        return to_route('patient.index');
    }

    public function render()
    {
        return view('livewire.penerima.penerima-create');
    }
}
