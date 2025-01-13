@props([
    'name',
    'placeholder' => null,
    'value' => null,
    'password' => null,
    'profile_page' => null,
    'label' => null,
])

@php
    $type = $password ? 'password' : 'text';
@endphp

@if($profile_page)
<div class="w-full flex flex-col gap-y-1">
    <label for="{{ $name }}">{{ $label }}</label>
@endif
    <div class="w-full">
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes }} 
        @class([
            "bg-transparent w-full h-10 pl-2 focus:outline-none border-b-2 border-gray-400 text-gray-900 dark:text-white" => !$profile_page,
            "bg-transparent w-full h-10 pl-2 border-2 border-gray-400 rounded-md text-gray-900 dark:text-white" => $profile_page
        ])
        >
        @error($name)
            <div class="text-red-600 dark:text-red-400 mt-1 text-sm">{{ $message }}</div>
        @enderror
    </div>
@if($profile_page)
</div>
@endif