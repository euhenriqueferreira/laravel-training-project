@props([
    'username' => __('You'),
])

<div class="h-16 shadow-sm px-5 sticky z-30 top-0 bg-gray-100 dark:bg-gray-900 dark:border-b dark:border-gray-700/40">
    <div class="w-full h-full max-w-screen-lg mx-auto flex items-center justify-between gap-x-4">
        <x-anchor href="{{ route('dashboard') }}">
            <x-img :src="asset('images/fish.png')" alt="Logo" class="w-14 h-14 object-contain cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />    
        </x-anchor>{{-- Logo --}}

        <div class="flex-1">

        </div>

        <div x-data="{ dropdownOpen: false, logoutConfirmation: false }" class="relative">
            <x-anchor
                @click.prevent="dropdownOpen = !dropdownOpen"
                x-bind:class="{'bg-gray-200 dark:bg-gray-700': dropdownOpen, 'bg-transparent': !dropdownOpen}"
                href="" class="flex items-center gap-x-1 no-underline text-base py-1.5 px-4 hover:bg-gray-200 dark:hover:bg-gray-700 transition rounded-md text-gray-900 dark:text-white" nav-button>
                <p class="block truncate max-w-[100px] ">{{ $username }}</p>
                <x-svg model="chevron-down" width="5" height="5" color="gray-900" darkThemeColor="white" />
            </x-anchor>
            <div
                class="absolute right-0 top-[110%] bg-gray-200 dark:bg-gray-700 rounded-md min-w-full"
                @click.outside="dropdownOpen = false"
                x-show="dropdownOpen"
                x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            >
                <x-anchor href="{{ route('profile') }}" class="flex items-center justify-between gap-x-1 no-underline text-base w-full bg-transparent py-2 px-3 hover:bg-gray-300 dark:hover:bg-gray-600 transition rounded-md text-gray-900 dark:text-white">
                    {{ __('profile.profile') }}
                    <x-svg model="user-circle" width="5" height="5" color="gray-900" darkThemeColor="white" />
                </x-anchor>
                <x-anchor href="{{ route('logout') }}" @click.prevent="logoutConfirmation = true" class="flex items-center justify-between gap-x-1 no-underline text-base w-full bg-transparent py-2 px-3 hover:bg-gray-300 dark:hover:bg-gray-600 transition rounded-md text-gray-900 dark:text-white">
                    {{ __('auth.logout') }}
                    <x-svg model="logout" width="5" height="5" color="gray-900" darkThemeColor="white" />
                </x-anchor>

                <div x-show="logoutConfirmation" class="w-screen h-screen bg-black/60 fixed left-0 top-0 z-50 flex items-center justify-center"
                    x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                >
                    <div @click.outside="logoutConfirmation = false" class="bg-white dark:bg-gray-800 rounded-lg px-6 py-4 max-w-[450px]">
                        <h1 class="text-gray-800 dark:text-white text-3xl font-bold text-center mb-4">{{ __('auth.logout') }}</h1>
                        <x-img :src="asset('images/fish.png')" alt="Logo" class="w-28 h-28 object-contain mx-auto mb-8 cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />
                        <p class="whitespace-pre-wrap text-base text-left text-gray-800 dark:text-white mb-5">{{ __('auth.logout_warning') }}</p>
                        <x-form :action="route('logout')" get class="space-y-4">
                            <x-button gradient>{{ __('auth.logout') }}</x-button>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
        
        <x-switch-theme />
    </div>
</div>