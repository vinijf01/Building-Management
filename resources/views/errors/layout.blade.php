<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @vite('resources/css/app.css') {{-- pastikan Tailwind sudah ter-setup --}}
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="text-center px-6">
        <h1 class="text-9xl font-extrabold text-blue-600 drop-shadow-lg">
            @yield('code')
        </h1>
        <p class="mt-4 text-2xl font-semibold text-gray-800">
            @yield('message')
        </p>
        <p class="mt-2 text-gray-600">
            Halaman yang kamu cari tidak ditemukan atau sudah dipindahkan.
        </p>

        <div class="mt-6 flex justify-center gap-4">
            <a href="{{ url('/') }}" 
               class="px-6 py-3 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
                Kembali ke Beranda
            </a>
            <a href="{{ url()->previous() }}" 
               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl shadow hover:bg-gray-300 transition">
                Halaman Sebelumnya
            </a>
        </div>
    </div>
</body>
</html>
