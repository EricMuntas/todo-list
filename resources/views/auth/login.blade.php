@extends('layouts.template')
@section('title', 'Login')
@section('content')
    <main class="scroll-custom w-full md:w-4/6">
        <div class="content-frame scroll-custom">
            <div class="list-item-border">
                <h1 class="title-label">Login</h1>
                <span class="title-divisor"></span>
                <form action="{{ route('auth.login') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')

                    {{-- Username --}}
                    <div>
                        <label for="username" class=" color-label">Username or email:</label>
                        <input type="text" name="username" id="username" placeholder="Enter your username or email..."
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{ old('username') }}">
                        @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}


                    {{-- Password --}}
                    <div>
                        <label for="password" class="color-label">Password:</label>

                        <div class="flex items-center gap-2">
                            <input type="password" name="password" id="password" placeholder="Enter your password..."
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <button type="button" class="" onclick="changePasswordInputType()">
                                <svg id="eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="rememberToken" id="" class="scale-125 ml-1 focus:outline-none focus:ring-0">Remember me
                    </div>
                    {{-- Submit Button --}}


                    <div class="flex justify-between">
                        <span class="text-sm flex justify-end gap-1">Don't have an account?
                            <a href="{{ route('show.register') }}" class="text-blue-500 hover:underline font-medium">
                                Register
                            </a>
                        </span>
                        <button type="submit"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Login
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </main>
@endsection

<script>
    function changePasswordInputType() {

        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye');

        if (passwordInput.type === 'password') {
            // Mostra la contrasenya
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
        </svg>
    `;
        } else {

            passwordInput.type = 'password';
            eyeIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
    `;
        }
    }
</script>
