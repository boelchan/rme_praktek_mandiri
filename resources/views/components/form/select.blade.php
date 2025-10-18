@props([
    'class' => null,
    'label' => '',
    'model' => '',
    'options' => [],
    'floating' => false,
    'live' => false,
    'change' => false,
])

@if ($floating)
    <label class="floating-label">
        <select @if ($live) wire:model.live="{{ $model }}" @else
                wire:model="{{ $model }}" @endif
            id="{{ $model }}" class="select {{ $class }} w-full">
            <option value="">Pilih</option>
            @foreach ($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <span>{{ $label }}</span>
    </label>
@else
    <fieldset class="fieldset">
        <legend class="fieldset-legend">{{ $label }}</legend>

        <select
            @if ($live) wire:model.live="{{ $model }}"
            {{-- @elseif ($change) wire:model.change="{{ $model }}" --}}
            @else
                wire:model="{{ $model }}" @endif
            id="{{ $model }}" class="select {{ $class }} w-full">
            <option value="">Pilih</option>
            @foreach ($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>

        <x-form.error :name="$model" />
    </fieldset>
@endif
