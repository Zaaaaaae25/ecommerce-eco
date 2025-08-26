@extends('layouts.app')

@section('content')
    {{-- Navbar --}}
    <x-navbar />

    <div class="max-w-7xl mx-auto px-6 py-10">
        {{-- Breadcrumb --}}
        <div class="text-sm text-gray-500 mb-4">
            <a href="/" class="hover:underline">Home</a> >
            <a href="/shop" class="hover:underline">Shop</a> >
            <span class="text-gray-700">Cart</span>
        </div>

        <h2 class="text-2xl font-semibold mb-6">Shopping Cart</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- Item 1 --}}
                <div class="flex items-center justify-between border rounded-lg p-4">
                    <div class="flex items-center space-x-4">
                        <img src="https://via.placeholder.com/80"
                             class="w-20 h-20 object-cover rounded" alt="">
                        <div>
                            <h4 class="font-semibold">Organic Cotton T-Shirt</h4>
                            <p class="text-sm text-gray-500">Size: M, Color: Natural</p>
                            <p class="text-gray-700">$29.99</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button class="px-2 py-1 border rounded">-</button>
                            <span>2</span>
                            <button class="px-2 py-1 border rounded">+</button>
                        </div>
                        <p class="font-semibold">$59.98</p>
                        <button class="text-red-500 hover:text-red-700">🗑</button>
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="flex items-center justify-between border rounded-lg p-4">
                    <div class="flex items-center space-x-4">
                        <img src="https://via.placeholder.com/80"
                             class="w-20 h-20 object-cover rounded" alt="">
                        <div>
                            <h4 class="font-semibold">Bamboo Water Bottle</h4>
                            <p class="text-sm text-gray-500">500ml, Eco-friendly</p>
                            <p class="text-gray-700">$24.99</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button class="px-2 py-1 border rounded">-</button>
                            <span>1</span>
                            <button class="px-2 py-1 border rounded">+</button>
                        </div>
                        <p class="font-semibold">$24.99</p>
                        <button class="text-red-500 hover:text-red-700">🗑</button>
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="flex items-center justify-between border rounded-lg p-4">
                    <div class="flex items-center space-x-4">
                        <img src="https://via.placeholder.com/80"
                             class="w-20 h-20 object-cover rounded" alt="">
                        <div>
                            <h4 class="font-semibold">Reusable Shopping Bag</h4>
                            <p class="text-sm text-gray-500">Canvas, Large Size</p>
                            <p class="text-gray-700">$12.99</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button class="px-2 py-1 border rounded">-</button>
                            <span>1</span>
                            <button class="px-2 py-1 border rounded">+</button>
                        </div>
                        <p class="font-semibold">$12.99</p>
                        <button class="text-red-500 hover:text-red-700">🗑</button>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="border rounded-lg p-6 space-y-4">
                <h3 class="text-lg font-semibold">Order Summary</h3>
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>$97.96</span>
                </div>
                <div class="flex justify-between">
                    <span>Shipping</span>
                    <span>$8.99</span>
                </div>

                {{-- Discount --}}
                <div class="flex space-x-2">
                    <input type="text" placeholder="Enter code"
                           class="flex-1 border rounded px-3 py-2 text-sm">
                    <button class="bg-gray-900 text-white px-3 py-2 rounded">Apply</button>
                </div>

                <div class="flex justify-between font-semibold text-lg">
                    <span>Total</span>
                    <span>$106.95</span>
                </div>

                <a href="#"
                   class="block w-full text-center bg-gray-900 text-white py-3 rounded hover:bg-gray-800">
                    Proceed to Checkout
                </a>
                <a href="/shop" class="block text-center text-sm text-gray-600 hover:underline">Continue Shopping</a>
            </div>
        </div>

        {{-- Recommendations --}}
        <div class="mt-12">
            <h3 class="text-lg font-semibold mb-6">You may also like</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                {{-- gunakan komponen card/product kamu --}}
                <x-product-card />
                <x-product-card />
                <x-product-card />
                <x-product-card />
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <x-footer />
@endsection
