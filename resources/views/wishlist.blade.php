{{-- resources/views/wishlist.blade.php --}}
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
    {{-- Empty State --}}
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
    {{-- Toolbar Top --}}
    <div class="bg-white border border-slate-200 rounded-xl p-4 mb-6 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <span class="text-slate-600">{{ $products->total() }} items</span>
        <label class="inline-flex items-center gap-2 select-none">
          <input id="selectAll" type="checkbox" class="rounded border-slate-300">
          <span class="text-slate-700">Select All</span>
        </label>
      </div>

      <div class="flex items-center gap-3">
        {{-- Sort --}}
        <form method="GET" action="{{ route('wishlist') }}">
          <select name="sort" class="rounded-lg border-slate-300 text-slate-700 text-sm"
                  onchange="this.form.submit()">
            <option value="newest"     {{ ($sort ?? request('sort','newest'))==='newest'?'selected':'' }}>Sort by: Newest</option>
            <option value="price-asc"  {{ ($sort ?? request('sort'))==='price-asc'?'selected':'' }}>Price: Low to High</option>
            <option value="price-desc" {{ ($sort ?? request('sort'))==='price-desc'?'selected':'' }}>Price: High to Low</option>
            <option value="eco-desc"   {{ ($sort ?? request('sort'))==='eco-desc'?'selected':'' }}>Eco Score: Best</option>
          </select>
        </form>

        {{-- Bulk Actions --}}
        <div class="flex items-center gap-2">
          {{-- Bulk Add to Cart --}}
          <form id="bulkAddForm" action="{{ route('wishlist.bulkAddToCart') }}" method="POST">
            @csrf
            <button type="submit"
              class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 disabled:opacity-50"
              data-bulk="add" disabled>
              Add Selected to Cart
            </button>
          </form>

          {{-- Bulk Remove --}}
          <form id="bulkRemoveForm" action="{{ route('wishlist.bulk-remove') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 disabled:opacity-50"
              data-bulk="remove" disabled>
              Remove Selected
            </button>
          </form>
        </div>
      </div>
    </div>

    {{-- Form dummy pembungkus grid agar checkbox bisa disalin ke dua form bulk --}}
    <form id="wishlistGridForm" onsubmit="return false">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $p)
          <div class="bg-white border border-slate-200 rounded-xl overflow-hidden relative">
            {{-- Checkbox per item (pojok kiri atas) --}}
            <label class="absolute top-2 left-2 z-10 bg-white/90 backdrop-blur px-2 py-1 rounded-md shadow border flex items-center gap-2 cursor-pointer">
              <input type="checkbox" name="ids[]" value="{{ $p->id }}" class="rowCheck rounded border-slate-300">
              <span class="text-xs text-slate-700">Select</span>
            </label>

            {{-- Gambar / placeholder --}}
            @php
              $img = data_get($p, 'image')
                  ?? data_get($p, 'image_url')
                  ?? 'https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop';
            @endphp
            <div class="h-40 bg-slate-200">
              <img src="{{ $img }}" alt="{{ e(data_get($p,'name') ?? data_get($p,'title','Product')) }}"
                   class="w-full h-full object-cover"
                   onerror="this.src='https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop'">
            </div>

            <div class="p-4">
              @php
                $title = data_get($p,'name') ?? data_get($p,'title','Product');
                $desc  = data_get($p,'short_description') ?? data_get($p,'description');
                $price = (float) data_get($p,'price',0);
                $cmp   = data_get($p,'compare_at_price');
                $eco   = data_get($p,'eco_score');
              @endphp

              <h3 class="font-semibold text-slate-900 line-clamp-2">{{ \Illuminate\Support\Str::limit($title, 80) }}</h3>
              @if($desc)
                <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ $desc }}</p>
              @endif

              <div class="flex items-center gap-2 text-slate-600 text-sm mt-2">
                @if(!is_null($eco))
                  <span>🍃 Eco Score: {{ number_format((float)$eco,1) }}/10</span>
                @endif
              </div>

              <div class="flex items-center justify-between mt-3">
                <div class="text-lg font-semibold text-slate-900">
                  ${{ number_format($price, 2) }}
                </div>
                @if(!is_null($cmp))
                  <div class="text-slate-400 line-through text-sm">
                    ${{ number_format((float)$cmp, 2) }}
                  </div>
                @endif
              </div>

              <div class="mt-4 space-y-2">
                {{-- Add single to cart --}}
                <form action="{{ route('cart.store') }}" method="POST" class="contents">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $p->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit"
                    class="w-full inline-flex justify-center px-4 py-2 rounded-lg bg-slate-900 text-white font-semibold hover:bg-slate-800">
                    Add to Cart
                  </button>
                </form>

                {{-- Remove single from wishlist (pakai bulk-remove dengan 1 id) --}}
                <form action="{{ route('wishlist.bulk-remove') }}" method="POST" class="contents">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="ids[]" value="{{ $p->id }}">
                  <button type="submit"
                    class="w-full inline-flex justify-center px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50">
                    Remove from Wishlist
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </form>

    {{-- Pagination --}}
    <div class="mt-8">
      {{ $products->appends(['sort' => $sort ?? null])->links() }}
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
(function () {
  const selectAll      = document.getElementById('selectAll');
  const bulkAddForm    = document.getElementById('bulkAddForm');
  const bulkRemoveForm = document.getElementById('bulkRemoveForm');
  const bulkButtons    = Array.from(document.querySelectorAll('[data-bulk]'));

  function rowChecks() {
    return Array.from(document.querySelectorAll('.rowCheck'));
  }

  function selectedIds() {
    return rowChecks().filter(cb => cb.checked).map(cb => cb.value);
  }

  function setBulkEnabled(enabled) {
    bulkButtons.forEach(btn => btn.disabled = !enabled);
  }

  function syncForms() {
    const ids = selectedIds();

    // Hapus input hidden lama
    [bulkAddForm, bulkRemoveForm].forEach(form => {
      Array.from(form.querySelectorAll('input[name="ids[]"]')).forEach(el => el.remove());
    });

    // Tambahkan input hidden ids[] sesuai pilihan
    ids.forEach(id => {
      const a = document.createElement('input');
      a.type = 'hidden'; a.name = 'ids[]'; a.value = id;
      bulkAddForm.appendChild(a);

      const r = document.createElement('input');
      r.type = 'hidden'; r.name = 'ids[]'; r.value = id;
      bulkRemoveForm.appendChild(r);
    });

    setBulkEnabled(ids.length > 0);

    // Set indeterminate state untuk selectAll
    if (selectAll) {
      const total = rowChecks().length;
      const selected = ids.length;
      selectAll.checked = (total > 0 && selected === total);
      selectAll.indeterminate = (selected > 0 && selected < total);
    }
  }

  // Select All
  if (selectAll) {
    selectAll.addEventListener('change', () => {
      rowChecks().forEach(cb => cb.checked = selectAll.checked);
      syncForms();
    });
  }

  // Perubahan tiap baris
  document.addEventListener('change', (e) => {
    if (e.target && e.target.classList.contains('rowCheck')) {
      syncForms();
    }
  });

  // Inisialisasi
  syncForms();
})();
</script>
@endpush
