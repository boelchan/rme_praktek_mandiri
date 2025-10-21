<x-layouts.content title="Kunjungan">
    <div class="card w-84 border border-neutral-300">
        <div class="card-body">
            <h2 class="card-title">Tambah Data</h2>
            <form wire:submit="store">
                <x-form.input label="Tanggal" model="encounter_date" type="date" required />
                <x-form.input label="Keluhan" model="condition_keluhan" />
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Tekanan Darah </legend>
                    <label class="input">
                        <input type="text" wire:model="observation_sistolik" placeholder="sistolik" />
                        <span class="label">/</span>
                        <input type="text" wire:model="observation_diastolik" placeholder="diastolik" />
                    </label>
                </fieldset>
                <x-form.textarea label="Lab" model="specimen" />
                <x-form.textarea label="Obat" model="medication" />
                <x-form.textarea label="Keterangan" model="encounter_keterangan" />

                <button class="btn btn-primary btn-soft mt-4">Simpan</button>
            </form>

        </div>
    </div>
</x-layouts.content>
