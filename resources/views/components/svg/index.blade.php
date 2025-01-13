@props([
    'model',
    'width' => '5',
    'height' => '5',
    'color' => 'gray-800',
    'darkThemeColor' => 'white',
])

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-{{ $width }} h-{{ $height }} text-{{ $color }} dark:text-{{ $darkThemeColor }}">
    @include('/components/svg/' . $model)
</svg>