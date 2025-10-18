<?php

namespace App\Livewire\Rekap;

use App\Models\Penerima;
use App\Models\Rekap;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class RekapEdit extends Component
{
    public $id;

    #[Validate('required|date')]
    public $tanggal;

    #[Validate('required')]
    public $penerimaId;

    #[Validate('required')]
    public $nominal;

    #[Validate('required')]
    public $created_by;

    public function mount($id)
    {
        $rekap = Rekap::where('id', $id)->where('uuid', request()->uuid)->firstOrFail();
        $this->id = $rekap->id;
        $this->tanggal = $rekap->tanggal;
        $this->penerimaId = $rekap->penerima_id;
        $this->nominal = $rekap->nominal;
        $this->created_by = $rekap->created_by;
    }

    public function update()
    {
        $this->validate();

        Rekap::where('id', $this->id)->update([
            'tanggal' => $this->tanggal,
            'penerima_id' => $this->penerimaId,
            'nominal' => $this->nominal,
        ]);

        Toaster::success('Data berhasil diupdate.');

        if (env('APP_ENV') === 'local') {
            return to_route('rekap.index');
        }

        return redirect('/rekap-transfer/rekap');
    }

    public function render()
    {
        return view('livewire.rekap.rekap-edit', [
            'penerimas' => Penerima::select(
                'id', DB::raw("CONCAT(nama, ' - ', nomor_rekening) as label")
            )
                ->pluck('label', 'id')->all()]);
    }
}
