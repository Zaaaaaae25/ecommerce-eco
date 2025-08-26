<div>
<div class="card">
    <img src="{{ $product['image'] ?? 'https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop' }}"
         alt="{{ $product['title'] ?? 'Product' }}"
         style="width:100%;height:160px;object-fit:cover;border-radius:10px" />

    <h4 style="margin-top:.75rem;font-weight:600">
        {{ \Illuminate\Support\Str::limit($product['title'] ?? 'Product', 60) }}
    </h4>

    <div class="muted" style="margin-top:.25rem">
        @if(isset($product['price']))
            ${{ number_format($product['price'], 2) }}
        @else
            Contact for price
        @endif
    </div>

    <div style="margin-top:.5rem;display:flex;justify-content:space-between;align-items:center">
        <a href="#" style="background:#0F172A;color:#fff;padding:.45rem .65rem;border-radius:6px;text-decoration:none;font-size:.85rem">
            Add to Cart
        </a>
        <span style="font-size:.8rem;color:#9CA3AF">{{ $product['category'] ?? '' }}</span>
    </div>
</div>
 z
</div>
