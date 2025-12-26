<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'TokoKu') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <div class="mb-4">
            <a href="/" class="flex items-center gap-2" style="text-decoration: none;">
                {{-- text-uppercase dihapus agar tulisan sesuai ketikan --}}
                <span class="demo fw-bolder" style="font-size: 2.25rem; letter-spacing: 1px; font-weight: 800;">
                    <span style="color: #696cff;">Toko</span><span style="color: #233446;">Ku</span>
                </span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

    </div>
</body>

</html>