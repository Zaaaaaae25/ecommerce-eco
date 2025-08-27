@props(['product' => null])

@php
  $name  = data_get($product, 'name') ?? data_get($product, 'title', 'Product');
  $cat   = data_get($product, 'category.name') ?? data_get($product, 'category', 'Eco');
  $price = (float) data_get($product, 'price', 0);
  $img   = data_get($product, 'image', 'https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop');
@endphp

<div class="bg-white border rounded-xl shadow-sm hover:shadow-md transition overflow-hidden group">
  <div class="h-44 bg-gray-100 relative">
    <img src="{{ $img }}" alt="{{ $name }}" class="object-cover w-full h-full">
    <span class="absolute top-2 left-2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded">Eco</span>
    <button class="absolute top-2 right-2 bg-white rounded-full p-1.5 shadow hover:scale-105 transition" aria-label="Like">
      <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
      </svg>
    </button>
  </div>

  <div class="p-4">
    <h3 class="font-semibold text-base">{{ \Illuminate\Support\Str::limit($name, 60) }}</h3>
    <p class="text-gray-500 text-sm">{{ $cat }}</p>
    <div class="flex items-center justify-between mt-3">
      <span class="font-bold text-slate-900">${{ number_format($price, 2) }}</span>

      @if($product instanceof \App\Models\Product)
        <form action="{{ route('cart.add', $product) }}" method="POST">
          @csrf
          <button type="submit"
                  class="bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm hover:bg-blue-700">
            Add to Cart
          </button>
        </form>
      @else
        <button class="bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm hover:bg-blue-700">
          Add to Cart
        </button>
      @endif
    </div>
  </div>
</div>
