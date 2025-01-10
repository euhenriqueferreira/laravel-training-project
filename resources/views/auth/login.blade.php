<x-layouts.guest>
    <div class="bg-white w-full max-w-md rounded-lg px-5 py-8 shadow-md">
        <h1 class="text-gray-800 text-3xl font-bold text-center mb-4">Sign In</h1>

        <x-img :src="asset('images/fish.png')" alt="Logo" class="w-28 h-28 object-contain mx-auto mb-8 cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />

        <x-form :action="route('login')" post class="space-y-3" id="form-login">
            <x-input name="email" placeholder="Email" :value="old('email')" />
            <x-input password name="password" placeholder="Password" />

            {{-- Error message for invalid credentials --}}
            @if(session('errorMessage'))
                <x-anchor :href="route('register')" underline>{{ session('errorMessage') }}</x-anchor>
            @endif

            {{-- Status for reset password (DONT REMOVE) --}}
            @if(session('status'))
                <p class="block text-green-600 text-sm">{{ session('status') }}</p>
            @endif

            <div class="flex justify-between items-center gap-x-6">
                <x-input.checkbox name="remember_me">Remember me</x-input.checkbox>
                <x-anchor :href="route('password.request')">I have forgotten my password</x-anchor>
            </div>

            <x-button gradient form="form-login">Sign In</x-button>
        </x-form>


        <div class="block text-center mt-6">
            <x-anchor :href="route('social.redirect', ['driver' => 'google'])" oauth2>
                <span>Login with Google</span>
                <x-svg.google />
            </x-anchor>

            <x-anchor :href="route('social.redirect', ['driver' => 'github'])" oauth2>
                <span>Login with Github</span>
                <x-svg.github />
            </x-anchor>
        </div>

        <div class="block text-center mt-10">
            <x-anchor :href="route('register')">Don't have an account? Sign Up</x-anchor>
        </div>
    </div>
</x-layouts.guest>