<?php

namespace App\Livewire\Penerima;

use App\Models\Penerima;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PenerimaEdit extends Component
{
    public $id;

    #[Validate('required')]
    public $nama;
    
    public $nomor_rekening;

    #[Validate('required')]
    public $alamat;

    public function mount($id)
    {
        $data = Penerima::findOrFail($id);
        $this->id = $data->id;
        $this->nama = $data->nama;
        $this->nomor_rekening = $data->nomor_rekening;
        $this->alamat = $data->alamat;
    }

    protected function rules()
    {
        return [
            'nomor_rekening' => [
                'required',
                Rule::unique('penerimas', 'nomor_rekening')->ignore($this->id),
            ],
        ];
    }

    public function update()
    {
        $this->validate();

        $data = Penerima::findOrFail($this->id);
        $data->update([
            'nama' => $this->nama,
            'nomor_rekening' => $this->nomor_rekening,
            'alamat' => $this->alamat,
        ]);

        session()->flash('message', 'Data berhasil diupdate.');

        return to_route('penerima.index');
    }

    public function render()
    {
        return view('livewire.penerima.penerima-edit');
    }
}
