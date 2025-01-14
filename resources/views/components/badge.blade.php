@props([
    'success' => null,
    'danger' => null,
    'alert' => null,
    'info' => null,
])

<div @class([
    "px-2 py-1 rounded-md  border-2  text-sm font-normal flex items-center justify-center",
    'bg-green-700/80 text-green-300 border-green-300' => $success,
    'bg-red-700/80 text-red-300 border-red-300' => $danger,
    'bg-yellow-700/80 text-yellow-300 border-yellow-300' => $alert,
    'bg-blue-700/80 text-blue-300 border-blue-300' => $info,
])>
    {{ $slot }}
</div>