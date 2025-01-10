<x-layouts.guest>
    <div class="bg-white w-full max-w-md rounded-lg px-5 py-8 shadow-md">
        <h1 class="text-gray-800 text-3xl font-bold text-center mb-4">Forgot Password</h1>

        <x-img :src="asset('images/fish.png')" alt="Logo" class="w-28 h-28 object-contain mx-auto mb-8 cursor-pointer hover:scale-105 hover:hue-rotate-60 transition" />

        <x-form :action="route('password.email')" post class="space-y-3">
            <p class="text-sm text-center">Please provide one of your email addresses so we can send you a link to reset your password.</p>

            <x-input name="email" placeholder="Email" :value="old('email')" />
            
            <x-button gradient>Send Reset Email</x-button>
        </x-form>

        
        <div class="block text-center mt-10">
            <x-anchor :href="route('login')">I remembered my password</x-anchor>
        </div>
    </div>
</x-layouts.guest>