<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    {{-- Menggunakan Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    {{-- Anda bisa include komponen navbar Anda di sini jika ada --}}
    {{-- <x-navbar /> --}}

    <div class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto">
            
            <!-- Kartu Profil Utama -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Profil Saya</h3>
                </div>
                <div class="p-6">
                    @if(Auth::check())
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 dark:text-gray-400">Nama</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 dark:text-gray-400">Email</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 dark:text-gray-400">Bergabung pada</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->created_at->format('d F Y') }}</span>
                            </div>
                        </div>

                        {{-- Tombol Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="mt-6">
                            @csrf
                            <button type="submit" class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                Logout
                            </button>
                        </form>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">
                            Silakan <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> untuk melihat profil Anda.
                        </p>
                    @endif
                </div>
            </div>

            <!-- Kartu Riwayat Pesanan -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md mt-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Riwayat Pesanan</h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 dark:text-gray-400">Riwayat pesanan Anda akan muncul di sini.</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
