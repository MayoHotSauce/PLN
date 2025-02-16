<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>PLN - Cek Tagihan</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .bg-animate {
                background: linear-gradient(-45deg, #ffffff, #f0f9ff, #e0f2fe, #f0f9ff);
                background-size: 400% 400%;
                animation: gradientBG 15s ease infinite;
                position: relative;
                overflow: hidden;
            }

            .bg-animate::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at 50% 50%, #3b82f620 0%, transparent 50%);
                animation: pulse 10s ease-in-out infinite;
            }

            @keyframes gradientBG {
                0% { background-position: 0% 50% }
                50% { background-position: 100% 50% }
                100% { background-position: 0% 50% }
            }

            @keyframes pulse {
                0% { transform: scale(1); opacity: 0.3; }
                50% { transform: scale(1.5); opacity: 0.1; }
                100% { transform: scale(1); opacity: 0.3; }
            }
        </style>
    </head>
    <body class="bg-animate">
        <div class="min-h-screen relative">
            <!-- Header -->
            <div class="relative pt-6 pb-16 sm:pb-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <nav class="relative flex items-center justify-between sm:h-10 md:justify-center">
                        <div class="flex items-center flex-1 md:absolute md:inset-y-0 md:left-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="/">
                                    <img class="h-8 w-auto sm:h-10" src="{{ asset('images/logo.png') }}" alt="PLN Logo">
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- Hero Section -->
                <main class="mt-16 mx-auto max-w-7xl px-4 sm:mt-24">
                    <div class="text-center">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Cek Tagihan Listrik</span>
                            <span class="block text-blue-600">dengan Mudah</span>
                        </h1>
                        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                            Masukkan nomor kontrol Anda untuk melihat tagihan listrik terbaru.
                        </p>
                    </div>

                    <!-- Form Cek Tagihan -->
                    <div class="mt-10 max-w-xl mx-auto">
                        <form action="{{ route('cek-tagihan') }}" method="POST" class="sm:flex justify-center">
                            @csrf
                            <div class="min-w-0 flex-1">
                                <label for="no_kontrol" class="sr-only">Nomor Kontrol</label>
                                <input type="text" 
                                       name="no_kontrol" 
                                       id="no_kontrol" 
                                       required 
                                       class="block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                       placeholder="Masukkan Nomor Kontrol">
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <button type="submit" 
                                        class="block w-full py-3 px-4 rounded-md shadow bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                                    Cek Tagihan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Fitur Cards -->
                    <div class="mt-20 grid grid-cols-1 gap-8 sm:grid-cols-3">
                        <!-- Card 1 -->
                        <div class="relative bg-white/80 backdrop-blur-sm p-6 rounded-lg shadow-sm">
                            <div class="text-center">
                                <div class="h-12 w-12 text-blue-600 mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Cepat</h3>
                                <p class="mt-2 text-sm text-gray-500">Lihat tagihan Anda dalam hitungan detik</p>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="relative bg-white/80 backdrop-blur-sm p-6 rounded-lg shadow-sm">
                            <div class="text-center">
                                <div class="h-12 w-12 text-blue-600 mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Aman</h3>
                                <p class="mt-2 text-sm text-gray-500">Data Anda terlindungi dengan aman</p>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="relative bg-white/80 backdrop-blur-sm p-6 rounded-lg shadow-sm">
                            <div class="text-center">
                                <div class="h-12 w-12 text-blue-600 mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Akurat</h3>
                                <p class="mt-2 text-sm text-gray-500">Informasi tagihan yang tepat dan terkini</p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
