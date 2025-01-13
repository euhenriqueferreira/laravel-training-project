@props([
    'name'
])

<div class="flex items-center space-x-1">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1">
    <label for="{{ $name }}" class="text-gray-900 dark:text-white text-sm">
        {{ $slot}}
    </label>
</div>