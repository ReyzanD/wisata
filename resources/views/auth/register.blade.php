<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800 dark:text-gray-200">Register</h2>
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div>
                    <x-input-label for="name_232136" :value="__('Name')" />
                    <x-text-input id="name_232136" class="block mt-1 w-full" type="text" name="name_232136" :value="old('name_232136')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name_232136')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email_232136" :value="__('Email')" />
                    <x-text-input id="email_232136" class="block mt-1 w-full" type="email" name="email_232136" :value="old('email_232136')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email_232136')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_232136" :value="__('Password')" />
                    <x-text-input id="password_232136" class="block mt-1 w-full" type="password" name="password_232136" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_232136')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_232136_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_232136_confirmation" class="block mt-1 w-full" type="password" name="password_232136_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_232136_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>