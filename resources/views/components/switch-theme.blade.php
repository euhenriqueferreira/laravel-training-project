@props([
    'guest' => null,
    'app' => null
])

<div id="theme-toggle" @class([
    'bg-white dark:bg-gray-800 w-10 h-10 rounded-md shadow-md flex items-center justify-center cursor-pointer hover:scale-105',
    "absolute  right-4 top-4 rounded-md shadow-md flex items-center justify-center cursor-pointer hover:scale-105" => $guest,
    "shadow-sm" => $app
    ])>
    <div id="light" class="hidden">
        <x-svg model="sun" width="6" height="6" color="gray-800" darkThemeColor="white" />
    </div>
    <div id="dark" class="hidden">
        <x-svg model="moon" width="6" height="6" color="gray-800" darkThemeColor="white" />
    </div>
</div>