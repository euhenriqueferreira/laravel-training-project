<x-layouts.guest>
    <div class="bg-white w-full max-w-md rounded-lg px-5 py-8 shadow-md">
        <h1 class="text-gray-800 text-3xl font-bold text-center mb-4">Register</h1>

        <x-img :src="asset('images/fish.png')" alt="Logo" class="w-28 h-28 object-contain mx-auto mb-8 cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />

        <x-form :action="route('register')" post class="space-y-3" id="form-register">
            <x-input name="name" placeholder="Name" :value="old('name')" />
            <x-input name="email" placeholder="Email" :value="old('email')" />
            <x-input password name="password" placeholder="Password" />
            <x-input password name="password_confirmation" placeholder="Password Confirmation" />

            @if(session('errorMessage'))
                <a href="{{ route('register') }}" class="block text-white underline text-sm">{{ session('errorMessage') }}</a>
            @endif

            <x-input.checkbox name="remember_me">Remember me</x-input.checkbox>

            <x-button gradient form="form-register">Sign Up</x-button>
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
            <x-anchor :href="route('login')">Already have an account? Sign In</x-anchor>
        </div>

    </div>
</x-layouts.guest>
