{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://source.unsplash.com/1600x900/?nature') no-repeat center center fixed;
            background-size: cover;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .form-container h1 {
            margin-bottom: 1.5rem;
            color: #333;
        }
        .form-container input {
            width: 100%;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }
        .form-container button {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            border: none;
            border-radius: 6px;
            background-color: #2aa6ff;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0055ff;
        }
        .form-container a {
            display: block;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>REGISTER</h1>
        <img src="{{ asset('assets/images/logo pdam.jpg') }}" alt="Logo PDAM" style="width: 120px; height: 120px; margin-bottom: 1rem;">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
            @error('name') <div style="color:red">{{ $message }}</div> @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email') <div style="color:red">{{ $message }}</div> @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password') <div style="color:red">{{ $message }}</div> @enderror

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            @error('password_confirmation') <div style="color:red">{{ $message }}</div> @enderror

            <!-- Tambahkan di dalam <form> sebelum tombol Register -->
            <div class="mb-3">
                <label for="role" class="form-label">Daftar Sebagai</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="operator">Operator</option>
                    <option value="asisten_manager">Asisten Manager</option>
                    <option value="manager">Manager</option>
                    <option value="direktur">Direktur</option>
                </select>
            </div>


            <button type="submit">Daftar</button>

            <a href="{{ route('login') }}">Sudah punya akun? Login di sini</a>
        </form>
    </div>
</body>
</html>
