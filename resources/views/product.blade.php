<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $product['title'] ?? 'Product Detail' }} — EcoMart</title>

    <!-- Fonts & Flowbite -->
    <link rel="stylesheet" href="resources/css/app.css">
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>
<style>
            /* Minimal fallback so layout still looks fine without Vite during quick preview */
            @import url('https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap');
            html,body{font-family:Figtree,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#F9FAFB;color:#0F172A;}
            .container{max-width:1400px;margin: auto;padding:0.5rem}
            .grid{display:grid;gap:1rem}
            .columns-2{grid-template-columns:1fr 1fr}
            .columns-3{grid-template-columns:repeat(3,1fr)}
            .card{background:#fff;border:1px solid #E5E7EB;border-radius:8px;padding:1rem}
            .muted{color:#6B7280}
            a.button{display:inline-block;padding:.6rem 1rem;border-radius:8px;text-decoration:none}
            a.primary{background:#0F172A;color:#fff}
            a.ghost{border:1px solid #E5E7EB;color:#0F172A}
        </style>

<body class="antialiased bg-gray-50 text-gray-800">
    <div class="container py-8">

        <!-- Product Overview -->

    {{-- Navbar --}}
    <x-navbar />

<button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="separator-sidebar"
  class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] transition-transform -translate-x-full sm:translate-x-0" style="margin-left: 3rem"
  aria-label="Sidebar">
  <div class="h-full px-4 py-6 overflow-y-auto bg-white border-r border-gray-200">

    <!-- Filter Section -->
    <h2 class="text-lg font-semibold text-gray-900 mb-6">Filters</h2>

    <!-- Categories -->
    <div class="mb-6">
      <h3 class="text-sm font-medium text-gray-700 mb-3">Categories</h3>
      <ul class="space-y-2">
        <li><label class="flex items-center space-x-2"><input type="checkbox" class="rounded border-gray-300"> <span>Fashion (24)</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="checkbox" class="rounded border-gray-300"> <span>Home & Living (18)</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="checkbox" class="rounded border-gray-300"> <span>Zero Waste (31)</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="checkbox" class="rounded border-gray-300"> <span>Beauty & Care (12)</span></label></li>
      </ul>
    </div>

    <!-- Price Range -->
    <div class="mb-6">
      <h3 class="text-sm font-medium text-gray-700 mb-3">Price Range</h3>
      <ul class="space-y-2">
        <li><label class="flex items-center space-x-2"><input type="radio" name="price" class="text-gray-600"> <span>Under $25</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="radio" name="price" class="text-gray-600"> <span>$25 - $50</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="radio" name="price" class="text-gray-600"> <span>$50 - $100</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="radio" name="price" class="text-gray-600"> <span>Over $100</span></label></li>
      </ul>
    </div>

    <!-- Material -->
    <div class="mb-6">
      <h3 class="text-sm font-medium text-gray-700 mb-3">Material</h3>
      <ul class="space-y-2">
        <li><label class="flex items-center space-x-2"><input type="checkbox" class="rounded border-gray-300"> <span>Organic Cotton</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="checkbox" class="rounded border-gray-300"> <span>Bamboo</span></label></li>
        <li><label class="flex items-center space-x-2"><input type="checkbox" class="rounded border-gray-300"> <span>Recycled Materials</span></label></li>
      </ul>
    </div>

    <!-- Apply Button -->
    <button class="w-full bg-gray-900 text-white py-2 rounded-lg font-medium hover:bg-gray-800 transition">Apply Filters</button>
  </div>
</aside>

<div class="p-4 sm:ml-64">
  <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h2 class="text-xl font-bold">Eco-Friendly Products</h2>
        <p class="text-gray-500">Showing 1–24 of 85 products</p>
      </div>
      <div>
        <select class="border rounded-md px-3 py-2 text-sm">
          <option>Sort by: Featured</option>
          <option>Price: Low to High</option>
          <option>Price: High to Low</option>
        </select>
      </div>
    </div>




    <!-- Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="bg-white border rounded-lg shadow relative overflow-hidden">

        <!-- Badge -->
        <span class="absolute top-2 left-2 bg-blue-900 text-white text-xs px-2 py-1 rounded">Eco-Friendly</span>

        <!-- Wishlist button -->
        <button class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
          </svg>
        </button>

        <!-- Image -->
        <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
          Product Image
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-lg">Organic Cotton Basic Tee</h3>
          <p class="text-gray-500 text-sm">Made from 100% organic cotton</p>
          <div class="flex items-center justify-between mt-3">
            <span class="font-bold">$29.99</span>
            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
              Add to Cart
            </button>
          </div>
        </div>
      </div>

      <!-- Ulangi card sesuai produk lainnya -->

    </div>
  </div>
</div>

    </div>

    {{-- Footer --}}
    <x-footer />





</body>
</html>
