{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>@yield('title', 'EcoMart')</title>

  {{-- ✅ CSRF meta untuk AJAX --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
      {{-- Fallback minimal jika Vite belum jalan --}}
      <link rel="preconnect" href="https://fonts.bunny.net" />
      <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
      <script src="https://cdn.tailwindcss.com"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
      <style>
        html,body{
          font-family:Figtree,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;
          background:#F9FAFB;color:#0F172A
        }
      </style>
  @endif

  {{-- Base URL untuk toggle wishlist (dipakai JS) --}}
  <script>
    window.APP = {
      wishlistToggleBase: "{{ url('/wishlist/toggle') }}"
    };
  </script>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

  {{-- Navbar --}}
  <x-navbar />

  {{-- Konten halaman --}}
  <main class="max-w-[1400px] mx-auto px-4 lg:px-6 py-6 lg:py-8">
    @yield('content')
  </main>

  {{-- Footer --}}
  <x-footer />

  {{-- Flowbite JS (opsional) --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

  {{-- ✅ Script global untuk toggle wishlist ❤️ --}}
  <script>
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('[data-wishlist-button]');
    if (!btn) return;

    // Ambil dari data-url kalau ada; kalau tidak, bangun dari base + productId
    const explicitUrl = btn.dataset.url || '';
    const productId   = btn.dataset.productId || '';
    const urlBase     = (window.APP && window.APP.wishlistToggleBase) ? window.APP.wishlistToggleBase : '';
    const url         = explicitUrl || (urlBase && productId ? (urlBase + '/' + productId) : '');

    if (!url) {
      console.error('Wishlist toggle URL missing. Pastikan tombol punya data-url atau data-product-id.');
      return;
    }

    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    const token     = tokenMeta ? tokenMeta.getAttribute('content') : null;

    try {
      const res = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': token || '',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
      });

      if (!res.ok) {
        const body = await res.text().catch(()=>'');
        console.error('Wishlist toggle failed:', res.status, body);
        alert('Gagal mengubah wishlist. (HTTP ' + res.status + ')');
        return;
      }

      const data = await res.json().catch(()=>null);
      if (!data || !('state' in data)) {
        console.error('Unexpected response:', data);
        alert('Respon server tidak valid.');
        return;
      }

      // Update ikon (warna & fill)
      const svg   = btn.querySelector('svg');
      const added = data.state === 'added';
      if (svg) {
        svg.classList.toggle('text-red-500', added);
        svg.classList.toggle('text-gray-600', !added);
        svg.setAttribute('fill', added ? 'currentColor' : 'none');
      }
      btn.setAttribute('aria-label', added ? 'Remove from wishlist' : 'Add to wishlist');
    } catch (err) {
      console.error(err);
      alert('Gagal mengubah wishlist. Coba lagi.');
    }
  });
  </script>

  {{-- Tempat untuk script tambahan per halaman --}}
  @stack('scripts')
</body>
</html>
