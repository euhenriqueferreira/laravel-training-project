<x-layouts.guest>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-full max-w-screen-sm bg-slate-800 rounded-md px-4 py-8">
            <h1 class="text-white text-2xl font-bold text-center">Register</h1>

            <form action="{{ route('register') }}" method="post" class="space-y-3" id="form-register">
                @csrf

                <div>
                    <input class="w-full rounded-md h-10 pl-3" type="text" name="name" placeholder="Name" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>

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

                <div>
                    <input class="w-full rounded-md h-10 pl-3" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password">
                </div>

                @if(session('errorMessage'))
                    <a href="{{ route('register') }}" class="block text-white underline text-sm">{{ session('errorMessage') }}</a>
                @endif

                <div class="flex justify-between items-center">
                    <button type="submit" form="form-register" class="bg-slate-600 text-white px-6 py-1 rounded-md hover:bg-slate-500 transition">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
    
</x-layouts.guest>
