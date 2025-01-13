<x-layouts.guest>
    <div class="bg-white dark:bg-gray-800 w-full max-w-md rounded-lg px-5 py-8 shadow-md">
        <h1 class="text-gray-800 dark:text-white text-3xl font-bold text-center mb-4">{{ __('auth.reset_password') }}</h1>

        <x-img :src="asset('images/fish.png')" alt="Logo" class="w-28 h-28 object-contain mx-auto mb-8 cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />

        <x-form :action="route('password.update')" post class="space-y-3">
            <x-input name="email" :placeholder="__('auth.email_placeholder')" :value="old('email', $email)" />
            <x-input password name="password" :placeholder="__('auth.password_placeholder')" />
            <x-input password name="password_confirmation" :placeholder="__('auth.password_confirmation_placeholder')" />

            <input type="hidden" name="token" value="{{ $token }}">
            
            <x-button gradient >{{ __('auth.reset_password_button') }}</x-button>
        </x-form>

    </div>
</x-layouts.guest>