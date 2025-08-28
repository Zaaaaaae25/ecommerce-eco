<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Profil - {{ Auth::user()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Simple transition for hover effects */
        .nav-link {
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <x-navbar />

    <div class="container mx-auto my-8 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Akun Saya</h1>
            <p class="text-gray-500 dark:text-gray-400">Kelola informasi akun dan lihat riwayat aktivitas Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Navigasi -->
            <aside class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-green-200 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-green-700">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Bergabung: {{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <nav class="space-y-2">
                        <a href="#profile" class="nav-link flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-md font-medium">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Profil Saya
                        </a>
                        <a href="#orders" class="nav-link flex items-center px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                           <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Riwayat Pesanan
                        </a>
                         <a href="#wishlist" class="nav-link flex items-center px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            Wishlist
                        </a>
                    </nav>
                     <form method="POST" action="{{ route('logout') }}" class="mt-8">
                        @csrf
                        <button type="submit" class="w-full text-red-600 dark:text-red-500 bg-red-50 dark:bg-gray-700 hover:bg-red-100 dark:hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Konten Utama -->
            <main class="lg:col-span-3 space-y-8">
                <!-- Detail Profil -->
                <div id="profile" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Detail Profil</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <span class="text-gray-500 dark:text-gray-400">Nama Lengkap</span>
                            <span class="sm:col-span-2 font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        </div>
                         <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <span class="text-gray-500 dark:text-gray-400">Alamat Email</span>
                            <span class="sm:col-span-2 font-medium text-gray-900 dark:text-white">{{ Auth::user()->email }}</span>
                        </div>
                        {{-- Tambahkan field lain jika ada, misal: alamat, telepon --}}
                    </div>
                </div>

                <!-- Riwayat Pesanan -->
                <div id="orders" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Riwayat Pesanan ({{ Auth::user()->orders->count() }})</h2>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse(Auth::user()->orders as $order)
                             <div class="py-3 flex flex-wrap justify-between items-center">
                                <div>
                                    <p class="font-semibold">Pesanan #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">{{ ucfirst($order->status) }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 py-4">Anda belum memiliki riwayat pesanan.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Wishlist -->
                <div id="wishlist" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Wishlist Saya ({{ Auth::user()->wishlists->count() }})</h2>
                     <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse(Auth::user()->wishlists as $item)
                            <div class="py-3 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . ($item->product->image ?? '')) }}" class="w-16 h-16 rounded object-cover" onerror="this.onerror=null;this.src='https://placehold.co/100x100?text=N/A';">
                                    <div>
                                        <p class="font-semibold">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <a href="#" class="text-sm font-medium text-green-600 hover:text-green-500">Pindahkan ke Keranjang</a>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 py-4">Wishlist Anda masih kosong.</p>
                        @endforelse
                    </div>
                </div>
            </main>

        </div>
    </div>
</body>
</html>
