<x-layouts.guest>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-full max-w-screen-sm bg-slate-800 rounded-md px-4 py-8">
            <h1 class="text-white text-2xl font-bold text-center">Login</h1>

            <form action="{{ route('login') }}" method="post" class="space-y-3" id="form-login">
                @csrf
                <div>
                    <input class="w-full rounded-md h-10 pl-3" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input class="w-full rounded-md h-10 pl-3" type="password" name="password" id="password" placeholder="Password">
                    @error('password')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Error message for invalid credentials --}}
                @if(session('errorMessage'))
                    <a href="{{ route('register') }}" class="block text-white underline text-sm">{{ session('errorMessage') }}</a>
                @endif

                {{-- Status for reset password (DONT REMOVE) --}}
                @if(session('status'))
                    <p class="block text-green-400 text-sm">{{ session('status') }}</p>
                @endif

                <div class="flex items-center space-x-1">
                    <input type="checkbox" name="remember_me" value="1">
                    <label for="remember_me" class="text-white">Remember me</label>
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit" form="form-login" class="bg-slate-600 text-white px-6 py-1 rounded-md hover:bg-slate-500 transition">Send</button>
                    <a href="{{ route('password.request') }}" class="text-white underline text-sm ">I have forgot my password</a>
                </div>
            </form>
            <div class="flex space-x-3 items-center">
                <a class="w-full block mt-2 bg-slate-600 text-white px-6 py-1 rounded-md hover:bg-slate-500 transition" href="{{ route('social.redirect', ['driver' => 'google']) }}">Login com o Google</a>
                <a class="w-full block mt-2 bg-slate-600 text-white px-6 py-1 rounded-md hover:bg-slate-500 transition" href="{{ route('social.redirect', ['driver' => 'github']) }}">Login com o Github</a>
            </div>
        </div>
    </div>
    
</x-layouts.guest>