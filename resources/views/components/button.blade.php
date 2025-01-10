@props([
    'type' => 'submit',
    'gradient' => null,
])


<button type="{{ $type}}" {{ $attributes }} @class([
    "w-full bg-gradient-to-r from-[#00dbde] to-[#fc00ff] text-white px-6 py-1 rounded-md hover:scale-[1.02] transition" => $gradient,
])>
    {{ $slot }}
</button>