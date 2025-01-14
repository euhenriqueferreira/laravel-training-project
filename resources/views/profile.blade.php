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
                            <p class="text-lg text-gray-300">Add an image</p>
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
                                <p class="text-lg text-gray-300">Add an image</p>
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
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">About me</h2>
            </div>
            <p class="max-h-32 text-base font-normal text-gray-900 dark:text-white">{{ $user->bio ? $user->bio : 'You don\'t have a bio yet.'}}</p>
       </div>{{-- About me --}}

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 py-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Profile Infos</h2>
            </div>
            <x-form :action="route('profile.update.infos')" class="flex flex-col gap-y-4" put>
                <x-input name="name" placeholder="Your name" :value="old('name', $user->name)" profile_page :label="__('Name')" />
                <x-input name="email" :value="old('email', $user->email)" profile_page :label="__('Email')" readonly/>
                <x-input.textarea name="bio" placeholder="Your biography" maxlength="500" :label="__('Bio')">{{ old('bio', $user->bio) }}
                </x-input.textarea>

                @if(session('errorMessage'))
                    <x-alert danger>{{ session()->get('errorMessage') }}</x-alert>
                @endif
                
                @if(session('successMessage'))
                    <x-alert success>{{ session()->get('successMessage') }}</x-alert>
                @endif

                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Change your password</h2>
                </div>
                <x-input password name="password" placeholder="Your password" profile_page :label="__('Password')"/>
                <x-input password name="new_password" placeholder="New Password" profile_page :label="__('New Password')"/>

                <x-input password name="new_password_confirmation" placeholder="Confirm your new Password" profile_page :label="__('New Password Confirmation')"/>
                
                <div class="w-full text-right">
                    <x-button default>Update</x-button>
                </div>
            </x-form>
        </div>{{-- Profile Update Form --}}
    </div>
</x-layouts.app>