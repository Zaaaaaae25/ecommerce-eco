{{-- resources/views/product.blade.php --}}
@extends('layouts.app')

@section('title', 'Eco-Friendly Products — EcoMart')

@section('content')
  <div class="grid grid-cols-1 lg:grid-cols-[16rem,1fr] gap-6">

    {{-- SIDEBAR / FILTERS --}}
    <aside class="lg:sticky lg:top-16 h-max bg-white border border-gray-200 rounded-lg p-5">
      <h2 class="text-lg font-semibold text-gray-900 mb-5">Filters</h2>

      <form id="filterForm" action="{{ route('product.index') }}" method="GET" class="space-y-6">
        {{-- Categories --}}
        <div>
          <h3 class="text-sm font-medium text-gray-700 mb-3">Categories</h3>
          <ul class="space-y-2 text-sm max-h-56 overflow-auto pr-1">
            @foreach(($categories ?? []) as $cat)
              @php $checked = in_array($cat->slug, $selectedCategories ?? []); @endphp
              <li>
                <label class="flex items-center gap-2">
                  <input type="checkbox" name="category[]" value="{{ $cat->slug }}"
                         class="rounded border-gray-300"
                         {{ $checked ? 'checked' : '' }}>
                  <span>{{ $cat->name }}</span>
                </label>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- Price Range --}}
        <div>
          <h3 class="text-sm font-medium text-gray-700 mb-3">Price Range</h3>
          @php $pr = $priceRange ?? ''; @endphp
          <ul class="space-y-2 text-sm">
            <li><label class="flex items-center gap-2">
              <input type="radio" name="price" value="under-25" class="rounded border-gray-300" {{ $pr==='under-25'?'checked':'' }}>
              <span>Under $25</span></label></li>

            <li><label class="flex items-center gap-2">
              <input type="radio" name="price" value="25-50" class="rounded border-gray-300" {{ $pr==='25-50'?'checked':'' }}>
              <span>$25 – $50</span></label></li>

            <li><label class="flex items-center gap-2">
              <input type="radio" name="price" value="50-100" class="rounded border-gray-300" {{ $pr==='50-100'?'checked':'' }}>
              <span>$50 – $100</span></label></li>

            <li><label class="flex items-center gap-2">
              <input type="radio" name="price" value="over-100" class="rounded border-gray-300" {{ $pr==='over-100'?'checked':'' }}>
              <span>Over $100</span></label></li>

            <li><label class="flex items-center gap-2">
              <input type="radio" name="price" value="" class="rounded border-gray-300" {{ $pr===''?'checked':'' }}>
              <span>Any</span></label></li>
          </ul>
        </div>

        {{-- Material (opsional) --}}
        @if(!empty($materials) && count($materials))
          <div>
            <h3 class="text-sm font-medium text-gray-700 mb-3">Material</h3>
            <ul class="space-y-2 text-sm">
              @foreach($materials as $m)
                @php $checked = in_array($m, $selectedMaterials ?? []); @endphp
                <li>
                  <label class="flex items-center gap-2">
                    <input type="checkbox" name="material[]" value="{{ $m }}"
                           class="rounded border-gray-300"
                           {{ $checked ? 'checked' : '' }}>
                    <span>{{ $m }}</span>
                  </label>
                </li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="flex gap-2">
          <button type="submit" class="w-full bg-gray-900 text-white py-2.5 rounded-lg font-medium hover:bg-gray-800 transition">
            Apply Filters
          </button>
          <a href="{{ route('product.index') }}"
             class="w-full text-center bg-white border border-gray-300 text-gray-700 py-2.5 rounded-lg font-medium hover:bg-gray-50 transition">
            Reset
          </a>
        </div>
      </form>
    </aside>

    {{-- CONTENT --}}
    <section class="space-y-5">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-bold">Eco-Friendly Products</h2>
          <p class="text-gray-500 text-sm">
            @php
              $first = $products->firstItem() ?? 1;
              $last  = $products->lastItem()  ?? $products->count();
              $total = method_exists($products, 'total') ? $products->total() : $products->count();
            @endphp
            Showing {{ $first }}–{{ $last }} of {{ $total }} products
          </p>
        </div>

        {{-- Sort by (GET) --}}
        <form action="{{ route('product.index') }}" method="GET" class="flex items-center gap-2">
          {{-- Pertahankan filter lain saat ganti sort --}}
          @foreach((array)request()->query() as $k => $v)
            @continue($k === 'sort' || $k === 'page')
            @if(is_array($v))
              @foreach($v as $vv)
                <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
              @endforeach
            @else
              <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endif
          @endforeach

          <label class="text-sm text-gray-600">Sort by</label>
          <select name="sort" class="border rounded-md px-3 py-2 text-sm" onchange="this.form.submit()">
            <option value="featured"  {{ ($sort ?? 'featured')==='featured'  ? 'selected' : '' }}>Featured</option>
            <option value="price-asc" {{ ($sort ?? '')==='price-asc' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price-desc"{{ ($sort ?? '')==='price-desc'? 'selected' : '' }}>Price: High to Low</option>
            <option value="newest"    {{ ($sort ?? '')==='newest'    ? 'selected' : '' }}>Newest</option>
          </select>
        </form>
      </div>

      {{-- GRID PRODUK --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
          {{-- Komponen card harus punya tombol ❤️ dengan data-wishlist-button & data-product-id --}}
          {{-- Disarankan tambahkan data-url="{{ route('wishlist.toggle', $product->id) }}" di tombolnya --}}
          <x-product-card :product="$product" />
        @empty
          <div class="col-span-full">
            <div class="p-6 bg-white border rounded-lg text-center text-gray-500">No products found.</div>
          </div>
        @endforelse
      </div>

      {{-- PAGINATION (pertahankan query) --}}
      @if(method_exists($products, 'links'))
        <div class="pt-2">
          {{ $products->appends(request()->query())->onEachSide(1)->links() }}
        </div>
      @endif
    </section>

  </div>
@endsection
