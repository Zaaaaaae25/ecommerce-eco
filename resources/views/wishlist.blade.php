{{-- resources/views/wishlist/index.blade.php --}}

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

@extends('layouts.app')


@section('title', 'My Wishlist — EcoMart')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
  {{-- Breadcrumb --}}
  <nav class="text-sm text-slate-500 mb-6">
    <ol class="flex items-center gap-2">
      <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
      <li>›</li>
      <li class="text-slate-700 font-medium">Wishlist</li>
    </ol>
  </nav>

  {{-- Heading --}}
  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-slate-800">My Wishlist <span class="align-middle">🖤</span></h1>
    <p class="text-slate-500 mt-2">Keep track of your favorite eco-friendly products</p>
  </div>

  @if($products->count() === 0)
    {{-- Empty state --}}
    <div class="bg-white border border-slate-200 rounded-xl p-10 text-center">
      <div class="text-5xl mb-3">🌿</div>
      <h3 class="text-xl font-semibold text-slate-800">Your wishlist is empty</h3>
      <p class="text-slate-500 mt-1">Browse eco-friendly items and save them for later.</p>
      <a href="{{ route('product.index') }}"
         class="inline-flex items-center mt-6 px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700">
        Browse Products
      </a>
    </div>
  @else
    {{-- Toolbar --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 mb-6 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <span class="text-slate-600">{{ $products->total() }} items</span>
        <label class="inline-flex items-center gap-2 select-none">
          <input id="selectAll" type="checkbox" class="rounded border-slate-300">
          <span class="text-slate-700">Select All</span>
        </label>
      </div>

      <div class="flex items-center gap-3">
        <form method="GET" action="{{ route('wishlist.index') }}">
          <select name="sort" class="rounded-lg border-slate-300 text-slate-700 text-sm"
                  onchange="this.form.submit()">
            <option value="newest"     {{ $sort==='newest'?'selected':'' }}>Sort by: Newest</option>
            <option value="price-asc"  {{ $sort==='price-asc'?'selected':'' }}>Price: Low to High</option>
            <option value="price-desc" {{ $sort==='price-desc'?'selected':'' }}>Price: High to Low</option>
            <option value="eco-desc"   {{ $sort==='eco-desc'?'selected':'' }}>Eco Score: Best</option>
          </select>
        </form>

        <button id="bulkAddToCart"
                class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800">
          Add Selected to Cart
        </button>
      </div>
    </div>

    {{-- Grid --}}
    <form id="wishlistForm" method="POST">
      @csrf
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $p)
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
          {{-- Placeholder gambar / thumbnail --}}
          <div class="h-40 bg-slate-200 flex items-center justify-center text-slate-500 text-sm">
            {{ $p->title ?? 'Product' }}
          </div>

          {{-- Body --}}
          <div class="p-4">
            <label class="inline-flex items-center gap-2 mb-2">
              <input type="checkbox" name="ids[]" value="{{ $p->id }}" class="rowCheck rounded border-slate-300">
            </label>

            <h3 class="font-semibold text-slate-900">{{ $p->title }}</h3>
            <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ $p->short_description }}</p>

            <div class="flex items-center gap-2 text-slate-600 text-sm mt-2">
              <span>🍃 Eco Score: {{ number_format($p->eco_score,1) }}/10</span>
            </div>

            <div class="flex items-center justify-between mt-3">
              <div class="text-lg font-semibold text-slate-900">
                ${{ number_format($p->price, 2) }}
              </div>
              @if($p->compare_at_price)
                <div class="text-slate-400 line-through text-sm">
                  ${{ number_format($p->compare_at_price, 2) }}
                </div>
              @endif
            </div>

            <div class="mt-4 space-y-2">
              <button type="button"
                      data-id="{{ $p->id }}"
                      class="addToCartBtn w-full inline-flex justify-center px-4 py-2 rounded-lg bg-slate-900 text-white font-semibold hover:bg-slate-800">
                Add to Cart
              </button>

              <button type="button"
                      data-id="{{ $p->id }}"
                      class="removeBtn w-full inline-flex justify-center px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">
                Remove from Wishlist
              </button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </form>

    {{-- Pagination --}}
    <div class="mt-8">
      {{ $products->links() }}
    </div>
  @endif
</div>

{{-- Minimal JS --}}
<script>
  // Select All
  const selectAll = document.getElementById('selectAll');
  const rowChecks = document.querySelectorAll('.rowCheck');
  if (selectAll) {
    selectAll.addEventListener('change', () => {
      rowChecks.forEach(cb => cb.checked = selectAll.checked);
    });
  }

  // Bulk Add to Cart
  const bulkAddBtn = document.getElementById('bulkAddToCart');
  if (bulkAddBtn) {
    bulkAddBtn.addEventListener('click', () => {
      const form = document.getElementById('wishlistForm');
      form.action = "{{ route('wishlist.bulkAddToCart') }}";
      form.method = "POST";
      form.submit();
    });
  }

  // Remove single from wishlist (AJAX-ish, fallback no-ajax bisa POST biasa)
  document.querySelectorAll('.removeBtn').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = "{{ route('wishlist.bulkRemove') }}";
      form.innerHTML = `@csrf @method('DELETE')
        <input type="hidden" name="ids[]" value="${id}">`;
      document.body.appendChild(form);
      form.submit();
    });
  });

  // Add single to cart (sesuaikan endpoint cart kamu)
  document.querySelectorAll('.addToCartBtn').forEach(btn => {
    btn.addEventListener('click', () => {
      // TODO: panggil route cart add (POST) sesuai implementasi kamu.
      alert('Simulasi: item dimasukkan ke cart.');
    });
  });
</script>
@endsection
