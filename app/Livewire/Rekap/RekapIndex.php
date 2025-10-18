<?php

namespace App\Livewire\Rekap;

use App\Livewire\Traits\WithTableX;
use App\Models\Rekap;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class RekapIndex extends Component
{
    use WithTableX;

    public $search_tanggal;

    public $search_nama_rekening;

    public $search_nomor_rekening;

    public $search_alamat;

    public $search_nominal;

    public function mount()
    {
        $this->sortField = 'tanggal';
        $this->sortDirection = 'desc';
    }

    public function delete($id)
    {
        $rekap = Rekap::findOrFail($id);
        if ($rekap->created_by != auth()->user()->id) {
            return Toaster::error('Anda tidak memiliki izin untuk menghapus data ini.');
        }
        $rekap->delete();
        Toaster::success('Data berhasil dihapus.');
    }

    public function render()
    {
        $data = Rekap::join('penerimas', 'rekaps.penerima_id', '=', 'penerimas.id')
            ->select('rekaps.*', 'penerimas.nama as nama_rekening', 'penerimas.nomor_rekening as nomor_rekening', 'penerimas.alamat as alamat')
            ->when($this->search_tanggal, fn ($q) => $q->where('tanggal', 'like', '%'.$this->search_tanggal.'%'))
            ->when($this->search_nama_rekening, fn ($q) => $q->where('penerimas.nama', 'like', '%'.$this->search_nama_rekening.'%'))
            ->when($this->search_nomor_rekening, fn ($q) => $q->where('penerimas.nomor_rekening', 'like', '%'.$this->search_nomor_rekening.'%'))
            ->when($this->search_alamat, fn ($q) => $q->where('penerimas.alamat', 'like', '%'.$this->search_alamat.'%'))
            ->when($this->search_nominal, fn ($q) => $q->where('nominal', 'like', '%'.$this->search_nominal.'%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage)
            ->onEachSide(1);

        return view('livewire.rekap.rekap-index', [
            'data' => $data,
        ]);
    }
}
