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
    <input class="bg-transparent w-full h-10 pl-2 focus:outline-none border-b-2 border-gray-400 text-gray-900 dark:text-white" type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes }}>
    @error($name)
        <div class="text-red-600 dark:text-red-400 mt-1 text-sm">{{ $message }}</div>
    @enderror
</div>