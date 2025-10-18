<?php

namespace App\Livewire\Rekap;

use App\Models\Penerima;
use App\Models\Rekap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class RekapCreate extends Component
{
    #[Validate('required|date')]
    public $tanggal;

    #[Validate('required')]
    public $penerimaId;

    #[Validate('required')]
    public $nominal;

    public $riwayat = [];

    public $penerima;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
    }

    public function updatingPenerimaId($value)
    {
        $this->penerima = Penerima::find($value);
    }

    public function store()
    {
        $this->validate();

        Rekap::create([
            'uuid' => Str::uuid(),
            'tanggal' => $this->tanggal,
            'penerima_id' => $this->penerimaId,
            'nominal' => $this->nominal,
            'created_by' => auth()->user()->id,
        ]);

        Toaster::success('Data berhasil disimpan.');

        if (env('APP_ENV') === 'local') {
            return to_route('rekap.index');
        }

        return redirect('/rekap-transfer/rekap');
    }

    public function render()
    {
        return view('livewire.rekap.rekap-create', [
            'penerimas' => Penerima::select(
                'id', DB::raw("CONCAT(nama, ' - ', nomor_rekening) as label")
            )
                ->pluck('label', 'id')->all()]
        );
    }
}
