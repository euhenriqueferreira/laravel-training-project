<x-layouts.app>
    <div class="max-w-screen-lg mx-auto mt-10 space-y-8 pb-10">
       <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <div class="bg-gray-400 w-full h-56 rounded-t-lg">
                <div x-data="{ hover: false }" class="relative w-full h-full flex items-center justify-center cursor-pointer" @mouseover="hover = true" @mouseleave="hover = false">
                    @if($user->cover_photo)
                        <img src="{{ Storage::url(auth()->user()->cover_photo) }}" alt="" class="w-full h-full object-cover rounded-t-lg">
                    @else
                        <div
                        x-show="!hover"
                        x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        >
                            <x-svg model="camera" width="20" height="20" color="gray-500" darkThemeColor="white" />
                        </div>
                    @endif
                    <x-form :action="route('profile.update.cover_photo')" x-ref="form" enctype="multipart/form-data" put>
                        <input type="file" name="cover_photo" id="cover_photo" class="hidden" @change="$refs.form.submit()">

                        <label
                        for="cover_photo"
                        x-show="hover"
                        x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="flex items-center justify-center gap-x-2 cursor-pointer w-full h-full absolute left-0 top-0 bg-gray-900/50">
                            <x-svg model="camera" width="8" height="8" color="gray-300" darkThemeColor="white" />
                            <p class="text-lg text-gray-300">{{ __('profile.add_an_image') }}</p>
                        </label>
                    </x-form>
                </div>
            </div>{{-- Cover Photo --}}

            <div class="h-fit pb-3 rounded-b-lg flex items-center justify-between gap-x-5 px-6">
                <div class="w-52 h-52 bg-gray-300 border-4 border-gray-200 rounded-full overflow-hidden -mt-32 relative">
                    <div x-data="{ hover: false}" class="relative w-full h-full flex items-center justify-center cursor-pointer"
                    @mouseover="hover = true" @mouseleave="hover = false"
                    >
                        @if($user->profile_photo)
                            <img src="{{ Storage::url(auth()->user()->profile_photo) }}" alt="" class="w-full h-full object-cover">
                        @else
                            <div
                            x-show="!hover"
                            x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                <x-svg model="camera" width="16" height="16" color="gray-700" darkThemeColor="white" />
                            </div>
                        @endif

                        <x-form :action="route('profile.update.profile_photo')" x-ref="form" enctype="multipart/form-data" put>
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" @change="$refs.form.submit()">
                            <label
                            for="profile_photo"
                            x-show="hover"
                            x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            class="flex flex-col items-center justify-center gap-x-2 cursor-pointer w-full h-full absolute left-0 top-0 bg-gray-900/50">
                                <x-svg model="camera" width="8" height="8" color="gray-300" darkThemeColor="white" />
                                <p class="text-lg text-gray-300">{{ __('profile.add_an_image') }}</p>
                            </label>
                        </x-form>
                    </div>
                </div>{{-- Profile Photo --}}

                <div class="flex-1 text-3xl font-semibold text-gray-900 dark:text-white">
                    {{ $user->name }}
                </div>

                {{-- TODO: Identify when other user is online or not --}}
                @if(auth()->user())
                    <x-badge success>online</x-badge>
                @else
                    <x-badge danger>offline</x-badge>
                @endif
            </div>{{-- Second Line--}}
       </div>{{-- Top Profile --}}

       <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 py-6">
            <div class="mb-5">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('profile.about_me') }}</h2>
            </div>
            <p class="whitespace-pre-wrap max-h-34 text-base font-normal text-gray-900 dark:text-white">{{ $user->bio ? $user->bio : 'You don\'t have a bio yet.'}}</p>
       </div>{{-- About me --}}

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 py-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">{{ __('profile.profile_infos') }}</h2>
            </div>
            <x-form :action="route('profile.update.infos')" class="flex flex-col gap-y-4" put>
                <x-input name="name" :placeholder="__('profile.name_placeholder')" :value="old('name', $user->name)" profile_page :label="__('profile.name_label')" />
                <x-input name="email" :value="old('email', $user->email)" profile_page :label="__('Email')" readonly/>
                <x-input.textarea name="bio" :placeholder="__('profile.bio_placeholder')" maxlength="500" :label="__('profile.bio_label')">{{ old('bio', $user->bio) }}
                </x-input.textarea>

                @if(session('errorMessage'))
                    <x-alert danger>{{ session()->get('errorMessage') }}</x-alert>
                @endif
                
                @if(session('successMessage'))
                    <x-alert success>{{ session()->get('successMessage') }}</x-alert>
                @endif

                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('profile.change_your_password') }}</h2>
                </div>

                <x-input password name="password" :placeholder="__('profile.password_placeholder')" profile_page :label="__('profile.password_label')"/>
                <x-input password name="new_password" :placeholder="__('profile.new_password_placeholder')" profile_page :label="__('profile.new_password_label')"/>
                <x-input password name="new_password_confirmation" :placeholder="__('profile.new_password_confirmation_placeholder')" profile_page :label="__('profile.new_password_confirmation_label')"/>
                
                <div class="w-full text-right">
                    <x-button default>{{ __('profile.button_submit') }}</x-button>
                </div>
            </x-form>
        </div>{{-- Profile Update Form --}}

        <div x-data="{ modalOpen: false }" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 py-6 flex items-center justify-between">
            <div class="space-y-1">
                <h2 class="text-xl font-semibold text-red-500 dark:text-red-500">{{ __('profile.delete_account') }}</h2>
                <p class="text-base font-normal text-gray-900/60 dark:text-white/60">{{ __('profile.delete_account_description') }}</p>
            </div>
            
            <x-anchor href="" danger @click.prevent="modalOpen = true">{{ __('profile.delete_account_button') }}</x-anchor>

            <div x-show="modalOpen" class="w-screen h-screen bg-black/60 fixed left-0 top-0 z-50 flex items-center justify-center"
                x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            >
                <div @click.outside="modalOpen = false" class="bg-white dark:bg-gray-800 rounded-lg px-6 py-4 max-w-[450px]">
                    <h1 class="text-gray-800 dark:text-white text-3xl font-bold text-center mb-4">{{ __('profile.delete_account') }}</h1>
                    <x-img :src="asset('images/fish.png')" alt="Logo" class="w-28 h-28 object-contain mx-auto mb-8 cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />
                    <p class="whitespace-pre-wrap text-base text-left text-gray-800 dark:text-white mb-5">{{ __('profile.delete_account_warning') }}</p>
                    
                    <x-form :action="route('profile.delete')" delete class="space-y-4">
                        <x-input password name="password_" :placeholder="__('profile.password_placeholder')" profile_page/>
                        <x-button gradient>{{ __('profile.delete_account_button') }}</x-button>
                    </x-form>
                </div>
            </div>
        </div>{{-- Delete account --}}

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 py-6 flex items-center justify-between">
            <div class="space-y-1">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('profile.verify_email') }}</h2>
                <p class="text-base font-normal text-gray-900/60 dark:text-white/60">{{ __('profile.verify_email_description') }}</p>
            </div>
            <x-form action="{{ route('verification.send')}}" post>
                <x-button outline>{{ __('profile.verify_email_button') }}</x-button>
            </x-form>
        </div>{{-- Email Verification --}}

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 py-6 flex items-center justify-between">
            <div class="space-y-1">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('profile.change_lang') }}</h2>
                <p class="text-base font-normal text-gray-900/60 dark:text-white/60">{{ __('profile.change_lang_description') }}</p>
            </div>
            <x-form x-data="{}" x-ref="form" action="{{ route('profile.set-locale') }}" put class="flex items-center justify-center">
                @foreach ($languages as $lang)
                    <div class="hover:bg-gray-400 transition border-gray-500 bg-gray-300 text-gray-900
                        @if($lang === $preferred_language) bg-blue-600 text-white border-blue-600 hover:bg-blue-500  @endif
                        @if($loop->first) rounded-l-md border-r @endif 
                        @if($loop->last) rounded-r-md border-l @endif">

                        <label for="preferred_lang{{ $lang }}" class="px-4 py-1 block w-full h-full cursor-pointer">{{ $lang }}</label>
                        <input type="checkbox" name="preferred_lang" id="preferred_lang{{ $lang }}" value="{{ $lang }}" class="hidden" @change="$refs.form.submit()">
                    </div>
                    @if($loop->last)
                    @endif
                @endforeach
            </x-form>
        </div>{{-- Email Verification --}}
    </div>
</x-layouts.app>