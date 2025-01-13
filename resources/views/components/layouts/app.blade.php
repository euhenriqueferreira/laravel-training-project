<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Tests</title>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div class="h-16 shadow-sm px-5">
        <div class="w-full h-full max-w-screen-lg mx-auto flex items-center justify-between">
            <div>
                <x-img :src="asset('images/fish.png')" alt="Logo" class="w-14 h-14 object-contain cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />    
            </div>{{-- Logo --}}

            <div x-data="{ dropdownOpen: false }" class="relative">
                <x-anchor 
                    @click.prevent="dropdownOpen = !dropdownOpen"
                    x-bind:class="{'bg-gray-200': dropdownOpen, 'bg-transparent': !dropdownOpen}"
                    href="" class="flex items-center gap-x-1 no-underline text-base py-1.5 px-4 hover:bg-gray-200 transition rounded-md text-gray-900" nav-button>
                    <p class="block truncate max-w-[100px] ">Username</p>
                    <x-svg model="chevron-down" width="5" height="5" color="gray-900" darkThemeColor="white" />
                </x-anchor>

                <div 
                    class="absolute right-0 top-[110%] bg-gray-200 rounded-md min-w-full"
                    @click.outside="dropdownOpen = false"
                    x-show="dropdownOpen" 
                    x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                >
                    <x-anchor href="" class="flex items-center justify-between gap-x-1 no-underline text-base w-full bg-transparent py-2 px-3 hover:bg-gray-300 transition rounded-md text-gray-900">
                        Profile
                        <x-svg model="user-circle" width="5" height="5" color="gray-900" darkThemeColor="white" />
                    </x-anchor>
                    <x-anchor href="{{ route('logout') }}" onclick="return confirm('Are you sure?')" class="flex items-center justify-between gap-x-1 no-underline text-base w-full bg-transparent py-2 px-3 hover:bg-gray-300 transition rounded-md text-gray-900">
                        Logout
                        <x-svg model="logout" width="5" height="5" color="gray-900" darkThemeColor="white" />
                    </x-anchor>
                </div>
            </div>
            
        </div>
    </div>

    {{-- <x-switch-theme /> --}}

    {{ $slot }}

    <script src="{{ asset('js/switchDarkMode.js') }}"></script>
</body>
</html>
