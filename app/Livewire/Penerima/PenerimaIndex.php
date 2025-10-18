<?php

namespace App\Livewire\Penerima;

use App\Livewire\Traits\WithTableX;
use App\Models\Penerima;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PenerimaIndex extends Component
{
    use WithTableX;

    public $search_nama;

    public $search_nomor_rekening;

    public function delete($id)
    {
        $data = Penerima::findOrFail($id);
        if ($data->rekap()->exists()) {
            return Toaster::error('Data tidak dapat dihapus karena sudah ada transaksi');
        }
        $data->delete();
        Toaster::success('Data berhasil dihapus');
    }

    public function render()
    {
        $data = Penerima::when($this->search_nama, fn ($q) => $q->where('nama', 'like', '%'.$this->search_nama.'%'))
            ->when($this->search_nomor_rekening, fn ($q) => $q->where('nomor_rekening', 'like', '%'.$this->search_nomor_rekening.'%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage)
            ->onEachSide(1);

        return view('livewire.penerima.penerima-index', [
            'data' => $data,
        ]);
    }
}
