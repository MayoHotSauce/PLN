<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative bg-gray-50 overflow-hidden min-h-screen">
            <!-- Header/Navbar -->
            <header class="relative bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="flex justify-between items-center py-6">
                        <div class="flex justify-start">
                            <a href="/" class="flex items-center">
                                <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="PLN Logo">
                                <span class="ml-2 text-xl font-bold text-gray-900">PLN</span>
                            </a>
                        </div>
                        <div>
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <main>
                <div class="relative bg-gray-50 overflow-hidden">
                    <div class="max-w-7xl mx-auto">
                        <div class="relative z-10 pb-8 bg-gray-50 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
                            <div class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                                <div class="text-center">
                                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                        <span class="block">Cek Tagihan Listrik</span>
                                        <span class="block text-blue-600">dengan Mudah</span>
                                    </h1>
                                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl">
                                        Masukkan nomor kontrol Anda untuk melihat tagihan listrik terbaru.
                                    </p>
                                </div>

                                <!-- Cek Tagihan Form -->
                                <div class="mt-10 sm:mt-12">
                                    <form action="{{ route('cek-tagihan') }}" method="POST" class="sm:max-w-xl sm:mx-auto">
                                        @csrf
                                        <div class="sm:flex sm:gap-4 justify-center">
                                            <div class="min-w-0 flex-1">
                                                <label for="no_kontrol" class="sr-only">Nomor Kontrol</label>
                                                <input type="text"
                                                       name="no_kontrol"
                                                       id="no_kontrol"
                                                       required
                                                       class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                       placeholder="Masukkan Nomor Kontrol">
                                            </div>
                                            <button type="submit"
                                                    class="mt-3 sm:mt-0 w-full sm:w-auto px-6 py-3 rounded-md shadow bg-blue-600 text-white font-medium hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Cek Tagihan
                                            </button>
                                        </div>
                                    </form>
                                    
                                    @if(session('error'))
                                        <div class="mt-4 text-red-600 text-center">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    
                                    @if(session('info'))
                                        <div class="mt-4 text-blue-600 text-center">
                                            {{ session('info') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
