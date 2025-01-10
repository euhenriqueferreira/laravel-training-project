@props([
    'href',
    'underline' => null,
    'oauth2' => null
])

<a href="{{ $href }}" {{ $attributes }} @class([
        "text-gray-900 text-sm text-center hover:underline",
        "block text-gray-900 underline text-sm text-left" => $underline,
        "w-full mt-2 border border-gray-300 bg-transparent text-gray-900 px-3 py-2 rounded-md transition text-left flex items-center justify-between hover:scale-[1.02] hover:no-underline" => $oauth2
    ])>
    {{ $slot }}
</a>