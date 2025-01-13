@props([
    'sessionKey' => null,
    'success' => null,
    'danger' => null,
    'alert' => null,
    'info' => null,
])


@if($sessionKey)
<div 
    x-data="{ sessionMessage: '{{ session($sessionKey) }}', showMessage: false }"
    x-init="if (sessionMessage) { showMessage = true; setTimeout(() => showMessage = false, 5000) }">
@endif
    <div
    @if($sessionKey)
    x-show="showMessage" 
    x-transition 
    @endif
    @class([
            'flex items-center justify-center gap-x-2 border-2 w-fit rounded-lg fixed bottom-5 left-1/2 -translate-x-1/2 py-3 px-4 text-base font-semibold',
            "bg-green-300/70  border-green-500 dark:bg-green-700 text-green-700 dark:text-green-300" => $success,
            "bg-red-300/70  border-red-500 dark:bg-red-700 text-red-700 dark:text-red-300" => $danger,
            "bg-yellow-300/70  border-yellow-500 dark:bg-yellow-700 text-yellow-700 dark:text-yellow-300" => $alert,
            "bg-blue-300/70  border-blue-500 dark:bg-blue-700 text-blue-700 dark:text-blue-300" => $info,
        ])>
    
        @if($success)
            <x-svg model="success" width="6" height="6" color="green-700" darkThemeColor="white" />
        @elseif($danger)
            <x-svg model="x-circle" width="6" height="6" color="red-700" darkThemeColor="white" />
        @elseif($alert)
            <x-svg model="triangle-alert" width="6" height="6" color="yellow-700" darkThemeColor="white" />
        @elseif($info)
            <x-svg model="info-alert" width="6" height="6" color="blue-700" darkThemeColor="white" />
        @endif

        @if($sessionKey)
            {{ session($sessionKey) }}
        @else
            {{ $slot }}
        @endif
    </div>
</div>