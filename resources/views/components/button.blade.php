@props([
    'type' => 'submit',
    'gradient' => null,
    'default' => null,
    'outline' => null,
])


<button type="{{ $type}}" {{ $attributes }} @class([
    "w-full bg-gradient-to-r from-[#00dbde] to-[#fc00ff] text-white px-6 py-1 rounded-md hover:scale-[1.02] transition" => $gradient,
    "text-md px-4 py-2 w-fit rounded-md bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:scale-[1.03] transition" => $default,
    "text-sm text-center px-4 py-2 rounded-md  border-2 text-lg font-semibold flex items-center justify-center text-gray-800 dark:text-white border-gray-800 dark:border-white hover:scale-[1.03] transition" => $outline
])>
    {{ $slot }}
</button>