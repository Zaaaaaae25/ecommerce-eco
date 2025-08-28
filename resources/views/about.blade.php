{{-- resources/views/about.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About — EcoMart</title>

  <!-- Fonts & Tailwind (fallback tanpa Vite) -->
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

  <style>
    html{ scroll-behavior:smooth; }
    /* Minimal fallback agar konsisten dengan landing page */
    @import url('https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap');
    html,body{font-family:Figtree,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#F9FAFB;color:#0F172A;}
    .container{max-width:1400px;margin:auto;padding:.5rem}
    .grid{display:grid;gap:1rem}
    .columns-2{grid-template-columns:1fr 1fr}
    .columns-3{grid-template-columns:repeat(3,1fr)}
    .columns-4{grid-template-columns:repeat(4,1fr)}
    .card{background:#fff;border:1px solid #E5E7EB;border-radius:12px;padding:1rem}
    .muted{color:#6B7280}
    .badge{display:inline-flex;align-items:center;gap:.5rem;border:1px solid #E5E7EB;border-radius:999px;padding:.35rem .7rem;font-size:.85rem}
    a.button{display:inline-block;padding:.6rem 1rem;border-radius:10px;text-decoration:none}
    a.primary{background:#0F172A;color:#fff}
    a.ghost{border:1px solid #E5E7EB;color:#0F172A}
  </style>
</head>

<body class="antialiased selection:bg-[#FF2D20] selection:text-white">
  <x-navbar />

  <div class="container">

    {{-- HERO ABOUT --}}
    <header class="grid columns-2" style="gap:2rem;margin-top:3rem;margin-bottom:3rem">
      <div>
        <h1 style="font-size:3rem;line-height:1.1;font-weight:700">Tentang EcoMart</h1>
        <p class="muted" style="margin-top:.75rem;max-width:55ch">
          Kami adalah marketplace berkelanjutan yang membantu Anda berbelanja produk ramah lingkungan tanpa kompromi pada kualitas dan gaya hidup.
          Misi kami sederhana: <strong>Shop Sustainable, Live Better</strong>.
        </p>
        <div style="margin-top:1rem;display:flex;gap:.75rem;flex-wrap:wrap">
          <span class="badge">♻️ Emisi < 1% per pesanan</span>
          <span class="badge">🌱 100% kemasan daur ulang</span>
          <span class="badge">🤝 Fair trade partners</span>
        </div>
        <div style="margin-top:1.25rem;display:flex;gap:.75rem;flex-wrap:wrap">
          <a href="{{ route('home') }}" class="button primary">Mulai Belanja</a>
          <a href="#values" class="button ghost">Nilai Kami</a>
        </div>
      </div>

      <div>
        <div class="rounded-xl overflow-hidden border border-gray-200 bg-white h-[340px] flex items-center justify-center">
          <img
            src="https://images.unsplash.com/photo-1585386959984-a4155223168f?q=80&w=1200&auto=format&fit=crop"
            alt="Eco-friendly packaging"
            style="width:100%;height:100%;object-fit:cover;object-position:center" />
        </div>
      </div>
    </header>

    {{-- MISI & VISI --}}
    <section id="mission" class="grid columns-2" style="gap:1rem;margin-bottom:2rem">
      <div class="card">
        <h3 class="text-xl font-semibold">Misi</h3>
        <p class="muted mt-2">
          Mempercepat transisi menuju konsumsi yang bertanggung jawab dengan kurasi produk ramah lingkungan yang terverifikasi.
        </p>
      </div>
      <div class="card">
        <h3 class="text-xl font-semibold">Visi</h3>
        <p class="muted mt-2">
          Menjadi platform rujukan gaya hidup berkelanjutan di Asia Tenggara dengan dampak nyata bagi manusia dan bumi.
        </p>
      </div>
    </section>

    {{-- DAMPAK / STATS --}}
    <section class="bg-white border border-gray-200 rounded-xl p-6" style="margin-bottom:2rem">
      <h3 class="text-2xl font-semibold text-center">Dampak Kami</h3>
      <p class="muted text-center mt-1">Metirik yang kami pantau untuk memastikan keberlanjutan</p>

      <div class="grid columns-4" style="gap:1rem;margin-top:1rem">
        <div class="card text-center">
          <div class="text-3xl font-bold">50k+</div>
          <div class="muted">Pelanggan</div>
        </div>
        <div class="card text-center">
          <div class="text-3xl font-bold">1M+</div>
          <div class="muted">Produk Terkirim</div>
        </div>
        <div class="card text-center">
          <div class="text-3xl font-bold">12k ton</div>
          <div class="muted">CO₂e Dihemat</div>
        </div>
        <div class="card text-center">
          <div class="text-3xl font-bold">95%</div>
          <div class="muted">Kepuasan</div>
        </div>
      </div>
    </section>

    {{-- NILAI (VALUES) --}}
    <section id="values" style="margin-bottom:2rem">
      <h3 class="text-2xl font-semibold text-center">Nilai Inti</h3>
      <p class="muted text-center mt-1">Pedoman kami dalam mengambil keputusan</p>

      <div class="grid columns-3" style="gap:1rem;margin-top:1rem">
        @php
          $values = $values ?? [
            ['title' => 'Transparansi', 'desc' => 'Label dampak yang jelas dan data sumber yang dapat diaudit.'],
            ['title' => 'Kualitas', 'desc' => 'Produk dipilih melalui uji kualitas dan kelayakan penggunaan harian.'],
            ['title' => 'Kolaborasi', 'desc' => 'Bekerja dengan UMKM dan brand lokal untuk memperluas dampak.'],
            ['title' => 'Sirkularitas', 'desc' => 'Mengutamakan bahan daur ulang dan desain tahan lama.'],
            ['title' => 'Etika', 'desc' => 'Standard fair wage dan supply chain yang bertanggung jawab.'],
            ['title' => 'Edukasi', 'desc' => 'Konten tips & kebiasaan kecil yang berdampak besar.'],
          ];
        @endphp

        @foreach($values as $v)
          <div class="card">
            <h4 class="font-semibold">{{ $v['title'] }}</h4>
            <p class="muted mt-2">{{ $v['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </section>

    {{-- TIMELINE SINGKAT --}}
    <section style="margin-bottom:2rem">
      <h3 class="text-2xl font-semibold text-center">Perjalanan Kami</h3>
      <div class="mt-3 grid columns-3" style="gap:1rem">
        <div class="card">
          <div class="font-semibold">2023</div>
          <p class="muted mt-1">Mulai dari katalog kecil 100 produk rumah tangga ramah lingkungan.</p>
        </div>
        <div class="card">
          <div class="font-semibold">2024</div>
          <p class="muted mt-1">Luncurkan label <em>Eco Score</em> dan program kemitraan brand lokal.</p>
        </div>
        <div class="card">
          <div class="font-semibold">2025</div>
          <p class="muted mt-1">Skala regional + fitur rekomendasi AI untuk belanja yang lebih cerdas.</p>
        </div>
      </div>
    </section>

    {{-- TEAM --}}
    <section id="team" style="margin-bottom:2rem">
      <h3 class="text-2xl font-semibold text-center">Tim Inti</h3>
      <p class="muted text-center mt-1">Orang-orang di balik EcoMart</p>

      @php
        $team = $team ?? [
          ['name'=>'Alya Putri','role'=>'CEO & Co-founder','avatar'=>'https://i.pravatar.cc/120?img=47'],
          ['name'=>'Dimas Kurnia','role'=>'Head of Sustainability','avatar'=>'https://i.pravatar.cc/120?img=12'],
          ['name'=>'Nadia Ramadhani','role'=>'Product Lead','avatar'=>'https://i.pravatar.cc/120?img=32'],
        ];
      @endphp

      <div class="grid columns-3" style="gap:1rem;margin-top:1rem">
        @forelse($team as $m)
          <div class="card text-center">
            <img src="{{ $m['avatar'] }}" alt="{{ $m['name'] }}" class="mx-auto rounded-full" style="width:80px;height:80px;object-fit:cover" />
            <div class="font-semibold mt-2">{{ $m['name'] }}</div>
            <div class="muted text-sm">{{ $m['role'] }}</div>
          </div>
        @empty
          <div class="card">Belum ada data tim.</div>
        @endforelse
      </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="bg-white border border-gray-200 rounded-xl p-6" style="margin-bottom:2rem">
      <h3 class="text-2xl font-semibold text-center">Pertanyaan Umum</h3>

      @php
        $faqs = $faqs ?? [
          ['q'=>'Apa itu Eco Score?','a'=>'Penilaian sederhana (0–100) yang merangkum dampak lingkungan produk berdasarkan bahan, proses produksi, dan kemasan.'],
          ['q'=>'Bagaimana kurasi produk?','a'=>'Kami periksa sertifikasi (mis. FSC, GOTS), transparansi pemasok, dan uji kualitas internal.'],
          ['q'=>'Apakah pengiriman ramah lingkungan?','a'=>'Kami menggunakan kemasan daur ulang dan mengimbangi jejak karbon pengiriman.'],
        ];
      @endphp

      <div class="mt-3 grid columns-3" style="gap:1rem">
        @foreach($faqs as $f)
          <div class="card">
            <div class="font-semibold">{{ $f['q'] }}</div>
            <p class="muted mt-2">{{ $f['a'] }}</p>
          </div>
        @endforeach
      </div>
    </section>

    {{-- CTA KONTAK --}}
    <section id="contact" class="card text-center" style="margin-bottom:3rem">
      <h3 class="text-xl font-semibold">Ingin bermitra atau punya saran?</h3>
      <p class="muted mt-1">Kami terbuka untuk kolaborasi brand dan program komunitas.</p>
      <div class="mt-3 flex items-center justify-center gap-2 flex-wrap">
        <a href="mailto:hello@ecomart.local" class="button primary">Hubungi Kami</a>
        <a href="{{ route('home') }}#assistant" class="button ghost">Tanya Asisten</a>
      </div>
    </section>

  </div>

  <x-footer />
</body>
</html>
