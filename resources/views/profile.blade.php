<x-layouts.app>
    <div class="max-w-screen-lg mx-auto mt-10 space-y-8 pb-10">
       <div class="shadow-lg rounded-lg">
            <div class="bg-gray-400 w-full h-56 rounded-t-lg">

                    <div x-data="{ hover: false }" class="relative w-full h-full flex items-center justify-center cursor-pointer" @mouseover="hover = true" @mouseleave="hover = false">
                        @if($user->cover_photo)
                            <img src="{{ Storage::url(auth()->user()->cover_photo) }}" alt="" class="w-full h-full object-cover">
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
                                <x-svg model="camera" width="8" height="8" color="gray-700" darkThemeColor="white" />
                                <p class="text-lg text-gray-700">Add an image</p>
                            </label>
                        </x-form>
                    </div>
              
            </div>

            <div class="h-fit pb-3 rounded-b-lg flex items-center justify-between gap-x-5 px-6">
                <div class="w-52 h-52 bg-gray-300 rounded-full overflow-hidden -mt-32">
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
                                    <x-svg model="camera" width="8" height="8" color="gray-500" darkThemeColor="white" />
                                    <p class="text-lg text-gray-500">Add an image</p>
                                </label>
                            </x-form>
                        </div>
                
                </div>

                <div class="flex-1 text-3xl font-semibold text-gray-900">
                    {{ $user->name }}
                </div>
                <x-button default>
                    Edit Profile
                </x-button>
            </div>
       </div>{{-- Top Profile --}}

       <div class="shadow-lg rounded-lg p-6 py-6">
            <div mb-5>
                <h2 class="text-xl font-semibold text-gray-900">About me</h2>
            </div>
            <p class="max-h-32">{{ $user->bio ? $user->bio : 'You don\'t have a bio yet.'}}</p>
       </div>

       <div class="shadow-lg rounded-lg p-6 py-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-5">Profile Infos</h2>
            </div>
            <x-form :action="route('profile.update.infos')" class="flex flex-col gap-y-4" put>
                <x-input name="name" :value="old('name', $user->name)" profile_page :label="__('Name')" />
                <x-input name="email" :value="old('email', $user->email)" profile_page :label="__('Email')" readonly/>
                <x-input.textarea name="bio" placeholder="Your biography" :label="__('Bio')">{{ old('bio', $user->bio) }}
                </x-input.textarea>

                @if(session('errorMessage'))
                    <p class="block text-red-600 dark:text-red-400 text-sm">{{ session('errorMessage') }}</p>
                @endif

                @if(session('successMessage'))
                    <p class="block text-green-600 dark:text-green-400 text-sm">{{ session('successMessage') }}</p>
                @endif

                <div class="bg-gray-300 dark:bg-gray-700 w-fit rounded-lg fixed bottom-5 left-1/2 -translate-x-1/2 py-3 px-6 text-base font-semibold text-gray-900 dark:text-white">
                    dajkldjaslkdakljdajdkljakldjaljdasl
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Change your password</h2>
                </div>
                <x-input password name="password" profile_page :label="__('Password')"/>
                <x-input password name="new_password" profile_page :label="__('New Password')"/>

                <x-input password name="new_password_confirmation" profile_page :label="__('New Password Confirmation')"/>
                
                <div class="w-full text-right">
                    <x-button default>Update</x-button>
                </div>
            </x-form>
        </div>
    </div>
</x-layouts.app>