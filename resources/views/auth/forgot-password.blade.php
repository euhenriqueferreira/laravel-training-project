<x-layouts.guest>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-full max-w-screen-sm bg-slate-800 rounded-md px-4 py-8">
            <h1 class="text-white text-2xl font-bold text-center">Forgot Password</h1>

            <form action="{{ route('password.email') }}" method="post" class="space-y-3">
                @csrf
                <div>
                    <input class="w-full rounded-md h-10 pl-3" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-white mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="bg-slate-600 text-white px-6 py-1 rounded-md hover:bg-slate-500 transition">Send Reset Email</button>
            </form>
        </div>
    </div>
    
</x-layouts.guest>