@props([
    'name',
    'placeholder' => null,
    'label' => null,
])

<div class="w-full flex flex-col gap-y-1">
    <label for="{{ $name }}" class="text-base font-normal text-gray-900 dark:text-white">{{ $label }}</label>
    <div class="w-full">
        <textarea id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $attributes }} 
        @class([
            "w-full resize-none bg-transparent min-h-32 max-h-56 pl-2 pt-2 border-2 border-gray-400 rounded-md text-gray-900 dark:text-white"
        ])
        >{{ $slot }}</textarea>

        @error($name)
            <div class="text-red-600 dark:text-red-400 mt-1 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>