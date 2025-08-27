
  <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
{{-- resources/views/layouts/cart.blade.php --}}
@extends('layouts.app')

@section('content')
  <x-navbar />

  <div class="max-w-7xl mx-auto px-6 py-8">
    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-6">
      <ol class="flex items-center gap-2">
        <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
        <li>›</li>
        <li><a href="{{ route('product.index') }}" class="hover:underline">Shop</a></li>
        <li>›</li>
        <li class="text-gray-800 font-medium">Cart</li>
      </ol>
    </nav>

    <h1 class="text-2xl font-semibold mb-1">Shopping Cart</h1>
    <p class="text-gray-500 mb-6">Review your items before checkout</p>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      {{-- LEFT: Items --}}
      <div class="lg:col-span-2 space-y-4">
        @php
          $hasItems = isset($items) && count($items);
        @endphp

        @if($hasItems)
          @foreach($items as $item)
            @php
              $p = $item->product;
              $line = ($p->price ?? 0) * $item->quantity;
            @endphp
            <div class="border rounded-lg p-4 bg-white">
              <div class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-4">
                  <div class="w-16 h-16 rounded-md bg-gray-100 overflow-hidden flex items-center justify-center">
                    <img src="{{ $p->image ?? 'https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop' }}"
                         alt="{{ $p->name }}" class="object-cover w-full h-full">
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-900">{{ $p->name }}</h4>
                    <p class="text-xs text-gray-500">Size: M, Color: Natural</p>
                    <p class="text-sm text-gray-600">
                      {{ $p->category?->name }}
                      · ${{ number_format($p->price ?? 0,2) }}
                    </p>
                  </div>
                </div>

                <div class="flex items-center gap-4">
                  {{-- qty control --}}
                  <div class="flex items-center gap-2">
                    <form action="{{ route('cart.update',$item) }}" method="POST">
                      @csrf @method('PATCH')
                      <input type="hidden" name="action" value="dec">
                      <button class="w-8 h-8 rounded border flex items-center justify-center hover:bg-gray-50">−</button>
                    </form>

                    <form action="{{ route('cart.update',$item) }}" method="POST" class="w-12">
                      @csrf @method('PATCH')
                      <input type="hidden" name="action" value="set">
                      <input name="quantity" type="number" min="1"
                             value="{{ $item->quantity }}"
                             class="w-full h-8 text-center border rounded">
                    </form>

                    <form action="{{ route('cart.update',$item) }}" method="POST">
                      @csrf @method('PATCH')
                      <input type="hidden" name="action" value="inc">
                      <button class="w-8 h-8 rounded border flex items-center justify-center hover:bg-gray-50">+</button>
                    </form>
                  </div>

                  {{-- line total --}}
                  <div class="w-20 text-right font-semibold text-gray-900">
                    ${{ number_format($line,2) }}
                  </div>

                  {{-- remove --}}
                  <form action="{{ route('cart.remove',$item) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-gray-400 hover:text-red-600" title="Remove">
                      {{-- trash icon --}}
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0h8a1 1 0 001-1V5a1 1 0 00-1-1h-3m-4 0H8a1 1 0 00-1 1v1" />
                      </svg>
                    </button>
                  </form>
                </div>

              </div>
            </div>
          @endforeach
        @else
          {{-- Fallback mock (sesuai desain) --}}
          @foreach([
            ['title'=>'Organic Cotton T-Shirt','sub'=>'Size: M, Color: Natural','price'=>29.99,'qty'=>2,'line'=>59.98],
            ['title'=>'Bamboo Water Bottle','sub'=>'500ml, Eco-friendly','price'=>24.99,'qty'=>1,'line'=>24.99],
            ['title'=>'Reusable Shopping Bag','sub'=>'Canvas, Large Size','price'=>12.99,'qty'=>1,'line'=>12.99],
          ] as $m)
            <div class="border rounded-lg p-4 bg-white">
              <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                  <div class="w-16 h-16 rounded-md bg-gray-100"></div>
                  <div>
                    <h4 class="font-medium text-gray-900">{{ $m['title'] }}</h4>
                    <p class="text-xs text-gray-500">{{ $m['sub'] }}</p>
                    <p class="text-sm text-gray-600">${{ number_format($m['price'],2) }}</p>
                  </div>
                </div>

                <div class="flex items-center gap-4">
                  <div class="flex items-center gap-2">
                    <button class="w-8 h-8 rounded border flex items-center justify-center hover:bg-gray-50">−</button>
                    <span>{{ $m['qty'] }}</span>
                    <button class="w-8 h-8 rounded border flex items-center justify-center hover:bg-gray-50">+</button>
                  </div>
                  <div class="w-20 text-right font-semibold">${{ number_format($m['line'],2) }}</div>
                  <button class="text-gray-400 hover:text-red-600" title="Remove">🗑️</button>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>

      {{-- RIGHT: Summary --}}
      <aside class="border rounded-lg p-6 bg-white h-fit">
        <h3 class="text-lg font-semibold mb-4">Order Summary</h3>

        <div class="space-y-2 text-sm">
          <div class="flex justify-between"><span>Subtotal</span>
            <span>
              @if(isset($subtotal))
                ${{ number_format($subtotal,2) }}
              @else
                $97.96
              @endif
            </span>
          </div>
          <div class="flex justify-between"><span>Shipping</span>
            <span>
              @if(isset($shipping))
                ${{ number_format($shipping,2) }}
              @else
                $8.99
              @endif
            </span>
          </div>

          @if( isset($discount) && $discount>0 )
            <div class="flex justify-between text-green-600">
              <span>Discount ({{ session('cart_code') }})</span>
              <span>- ${{ number_format($discount,2) }}</span>
            </div>
          @endif
        </div>

        <form action="{{ route('cart.apply-code') }}" method="POST" class="mt-4 flex gap-2">
          @csrf
          <input type="text" name="code" placeholder="Enter code"
                 value="{{ session('cart_code') }}"
                 class="flex-1 border rounded px-3 py-2 text-sm">
          <button class="bg-gray-900 text-white px-4 py-2 rounded text-sm hover:bg-gray-800">Apply</button>
        </form>

        <div class="flex justify-between items-center mt-4 pt-4 border-t">
          <span class="text-gray-600">Total</span>
          <span class="text-xl font-semibold">
            @if(isset($total))
              ${{ number_format($total,2) }}
            @else
              $106.95
            @endif
          </span>
        </div>

        <a href="#"
           class="block w-full text-center bg-gray-900 text-white py-3 rounded mt-4 hover:bg-gray-800">
          Proceed to Checkout
        </a>
        <a href="{{ route('product.index') }}"
           class="block text-center text-sm text-gray-600 hover:underline mt-2">
          Continue Shopping
        </a>
      </aside>
    </div>

    {{-- Recommendations --}}
    <section class="mt-12">
      <h3 class="text-lg font-semibold mb-6">You may also like</h3>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      @for($i=0;$i<4;$i++)
  <x-product-card :product="[
    'title' => 'Product',
    'category' => 'Eco',
    'price' => 0,
    'image' => 'https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop'
  ]"/>
@endfor

      </div>
    </section>
  </div>

  <x-footer />
@endsection
