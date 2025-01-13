@props([
    'href',
    'underline' => null,
    'oauth2' => null
])

<a href="{{ $href }}" {{ $attributes }} @class([
        "text-gray-900 dark:text-white text-sm text-center hover:underline underline sm:no-underline",
        "block text-gray-900 dark:text-white underline text-sm text-left" => $underline,
        "w-full mt-2 border border-gray-300 bg-transparent dark:bg-white text-gray-800 dark:text-gray-800 px-3 py-2 rounded-md transition text-left flex items-center justify-between hover:scale-[1.02] hover:no-underline" => $oauth2
    ])>
    {{ $slot }}
</a>