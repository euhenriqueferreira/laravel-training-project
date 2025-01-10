@props([
    'name',
    'placeholder' => null,
    'value' => null,
    'password' => null,
])

@php
    $type = $password ? 'password' : 'text';
@endphp

<div>
    <input class="w-full h-10 pl-2 focus:outline-none border-b-2 border-gray-400 text-gray-900" type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes }}>
    @error($name)
        <div class="text-red-600 mt-1 text-sm">{{ $message }}</div>
    @enderror
</div>