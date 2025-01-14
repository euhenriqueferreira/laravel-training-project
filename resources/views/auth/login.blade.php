<x-layouts.guest>
    <div class="bg-white dark:bg-gray-800 w-full max-w-md rounded-lg px-5 py-8 shadow-md">
        <h1 class="text-gray-800 dark:text-white text-3xl font-bold text-center mb-4">{{ __('auth.login')}}</h1>

        <x-img :src="asset('images/fish.png')" alt="Logo" class="w-28 h-28 object-contain mx-auto mb-8 cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />

        <x-form :action="route('login')" post class="space-y-3" id="form-login">
            <x-input name="email" :placeholder="__('auth.email_placeholder')" :value="old('email')" />
            <x-input password name="password" :placeholder="__('auth.password_placeholder')" />

            @if(session('errorMessage'))
                <x-alert danger>{{ session()->get('errorMessage') }}</x-alert>
            @endif
            
            @if(session('status'))
                <x-alert success>{{ session()->get('status') }}</x-alert>
            @endif

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-x-6 gap-y-1">
                <x-input.checkbox name="remember_me">{{ __('auth.remember_me') }}</x-input.checkbox>
                <x-anchor :href="route('password.request')">{{ __('auth.forgot_my_password') }}</x-anchor>
            </div>

            <x-button gradient form="form-login">{{ __('auth.login_button') }}</x-button>
        </x-form>


        <div class="block text-center mt-6">
            <x-anchor :href="route('social.redirect', ['driver' => 'google'])" oauth2>
                <span>{{ __('auth.login_with_google') }}</span>
                <x-svg.google />
            </x-anchor>

            <x-anchor :href="route('social.redirect', ['driver' => 'github'])" oauth2>
                <span>{{ __('auth.login_with_github') }}</span>
                <x-svg.github color="#ffffff" />
            </x-anchor>
        </div>

        <div class="block text-center mt-10">
            <x-anchor :href="route('register')">{{ __('auth.dont_have_an_account') }}</x-anchor>
        </div>
    </div>
</x-layouts.guest>