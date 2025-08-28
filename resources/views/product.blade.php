{{-- resources/views/product.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Eco-Friendly Products — EcoMart</title>

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
      {{-- Fallback minimal jika Vite belum jalan --}}
      <link rel="preconnect" href="https://fonts.bunny.net" />
      <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
       <script src="https://cdn.tailwindcss.com"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
      <style>
        html,body{font-family:Figtree,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#F9FAFB;color:#0F172A}
      </style>
  @endif
</head>
<body class="antialiased bg-gray-50 text-gray-800">

  {{-- Navbar --}}
  <x-navbar />

  <div class="max-w-[1400px] mx-auto px-4 lg:px-6 py-6 lg:py-8">

    <div class="grid grid-cols-1 lg:grid-cols-[16rem,1fr] gap-6">

      {{-- SIDEBAR / FILTERS --}}
      <aside class="lg:sticky lg:top-16 h-max bg-white border border-gray-200 rounded-lg p-5">
        <h2 class="text-lg font-semibold text-gray-900 mb-5">Filters</h2>

        <div class="mb-6">
          <h3 class="text-sm font-medium text-gray-700 mb-3">Categories</h3>
          <ul class="space-y-2 text-sm">
            <li><label class="flex items-center gap-2"><input type="checkbox" class="rounded border-gray-300"> <span>Fashion (24)</span></label></li>
            <li><label class="flex items-center gap-2"><input type="checkbox" class="rounded border-gray-300"> <span>Home & Living (18)</span></label></li>
            <li><label class="flex items-center gap-2"><input type="checkbox" class="rounded border-gray-300"> <span>Zero Waste (31)</span></label></li>
            <li><label class="flex items-center gap-2"><input type="checkbox" class="rounded border-gray-300"> <span>Beauty & Care (12)</span></label></li>
          </ul>
        </div>

        <div class="mb-6">
          <h3 class="text-sm font-medium text-gray-700 mb-3">Price Range</h3>
          <ul class="space-y-2 text-sm">
            <li><label class="flex items-center gap-2"><input type="radio" name="price"> <span>Under $25</span></label></li>
            <li><label class="flex items-center gap-2"><input type="radio" name="price"> <span>$25 – $50</span></label></li>
            <li><label class="flex items-center gap-2"><input type="radio" name="price"> <span>$50 – $100</span></label></li>
            <li><label class="flex items-center gap-2"><input type="radio" name="price"> <span>Over $100</span></label></li>
          </ul>
        </div>

        <div class="mb-6">
          <h3 class="text-sm font-medium text-gray-700 mb-3">Material</h3>
          <ul class="space-y-2 text-sm">
            <li><label class="flex items-center gap-2"><input type="checkbox" class="rounded border-gray-300"> <span>Organic Cotton</span></label></li>
            <li><label class="flex items-center gap-2"><input type="checkbox" class="rounded border-gray-300"> <span>Bamboo</span></label></li>
            <li><label class="flex items-center gap-2"><input type="checkbox" class="rounded border-gray-300"> <span>Recycled Materials</span></label></li>
          </ul>
        </div>

        <button class="w-full bg-gray-900 text-white py-2.5 rounded-lg font-medium hover:bg-gray-800 transition">
          Apply Filters
        </button>
      </aside>

      {{-- CONTENT --}}
      <section class="space-y-5">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-xl font-bold">Eco-Friendly Products</h2>
            <p class="text-gray-500 text-sm">Showing {{ $products->firstItem() ?? 1 }}–{{ $products->lastItem() ?? count($products) }} of {{ $products->total() ?? count($products) }} products</p>
          </div>
          <div class="flex items-center gap-2">
            <label class="text-sm text-gray-600">Sort by</label>
            <select class="border rounded-md px-3 py-2 text-sm">
              <option value="featured">Featured</option>
              <option value="price-asc">Price: Low to High</option>
              <option value="price-desc">Price: High to Low</option>
              <option value="newest">Newest</option>
            </select>
          </div>
        </div>

        {{-- GRID PRODUK --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($products as $product)
            <x-product-card :product="$product" />
          @empty
            <div class="col-span-full">
              <div class="p-6 bg-white border rounded-lg text-center text-gray-500">No products found.</div>
            </div>
          @endforelse
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($products, 'links'))
          <div class="pt-2">
            {{ $products->onEachSide(1)->links() }}
          </div>
        @endif
      </section>

    </div>
  </div>

  {{-- Footer --}}
  <x-footer />

  {{-- Flowbite JS (untuk komponen seperti drawer/dropdown) --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
