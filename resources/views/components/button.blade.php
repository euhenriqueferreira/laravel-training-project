@props([
    'type' => 'submit',
    'gradient' => null,
    'default' => null
])


<button type="{{ $type}}" {{ $attributes }} @class([
    "w-full bg-gradient-to-r from-[#00dbde] to-[#fc00ff] text-white px-6 py-1 rounded-md hover:scale-[1.02] transition" => $gradient,
    "text-md px-4 py-2 w-fit rounded-md bg-gray-900 text-white hover:scale-[1.03] transition" => $default
])>
    {{ $slot }}
</button>