@php

    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= null;
    $old ??= null;
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}">{{ $label ?? Str::ucfirst($name) }}</label>

    @if ($type == 'textarea')
        <textarea class="form-control  @error($name) is-invalid  @enderror" type="{{ $type }}" id="{{ $name }}"
            name="{{ $name }}" rows="3">{{ old($name,  $value) }}</textarea>
    @else
        <input class="form-control form-control-sm  @error($name) is-invalid  @enderror" type="{{ $type }}"
            id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">
    @endif

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
