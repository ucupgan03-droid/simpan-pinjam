<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">Ingat Saya</label>
        </div>

        <!-- Button & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            @if (Route::has('password.request'))
                <a class="text-decoration-none" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif

            <button type="submit" class="btn btn-primary px-4">
                LOG IN
            </button>
        </div>
        
        <!-- Link ke Register -->
        <div class="text-center mt-4">
            <small>Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a></small>
        </div>
    </form>
</x-guest-layout>