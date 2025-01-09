<x-layouts.guest>

    @if(session('errorMessage'))
        <a href="#">{{ session('errorMessage') }}</a>
    @endif

    <form action="{{ route('login') }}" method="post">
        @csrf

        <div>
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <input type="password" name="password" id="password" placeholder="Password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Send</button>
    </form>
</x-layouts.guest>