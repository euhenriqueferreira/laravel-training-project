@props([
    'src', 
    'alt',
])

<img src="{{ $src }}" alt="{{ $alt }}" title="{{ $alt }}" {{ $attributes }}>