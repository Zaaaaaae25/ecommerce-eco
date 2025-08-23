<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EcoMart — Sustainable Store</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <style>
    html {
  scroll-behavior: smooth;
}
</style>


    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Minimal fallback so layout still looks fine without Vite during quick preview */
            @import url('https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap');
            html,body{font-family:Figtree,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#F9FAFB;color:#0F172A;margin:0}
            .container{max-width:1100px;margin:0 auto;padding:1.5rem}
            .grid{display:grid;gap:1rem}
            .columns-2{grid-template-columns:1fr 1fr}
            .columns-3{grid-template-columns:repeat(3,1fr)}
            .card{background:#fff;border:1px solid #E5E7EB;border-radius:8px;padding:1rem}
            .muted{color:#6B7280}
            a.button{display:inline-block;padding:.6rem 1rem;border-radius:8px;text-decoration:none}
            a.primary{background:#0F172A;color:#fff}
            a.ghost{border:1px solid #E5E7EB;color:#0F172A}
        </style>
    @endif
</head>


<body class="antialiased selection:bg-[#FF2D20] selection:text-white">
    <div class="container">
        <!-- Header -->
        <header class="grid" style="grid-template-columns:1fr auto;">


<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">EcoMart</span>
  </a>
  <div class="flex md:order-2">
    <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
      </svg>
      <span class="sr-only">Search</span>
    </button>

    <div class="relative hidden md:block">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
        <span class="sr-only">Search icon</span>
      </div>

      <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
    </div>

    <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-search" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <button type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
    </svg>
    <span class="sr-only">Favorites</span>
  </button>
<button type="button" class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121 0 2.1-.738 2.356-1.822l1.334-5.334A1.125 1.125 0 0 0 21.312 6H6.272M7.5 14.25 5.106 5.272M10.5 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm9 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
    </svg>
    <span class="sr-only">Cart</span>

    <!-- badge jumlah item -->
    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full">3</span>
  </button>
  <button type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
       stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
  </svg>
  <span class="sr-only">Profile</span>
</button>

  </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
      <div class="relative mt-3 md:hidden">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>

        <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
      </div>
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
  <li>
    <a href="#home" class="scroll-smooth;block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500">Home</a>
  </li>
  <li>
    <a href="#shop" class="scroll-smoothblock py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500">Shop</a>
  </li>
  <li>
    <a href="#blog" class="scroll-smoothblock py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500">Blog</a>
  </li>
  <li>
    <a href="#assistant" class="scroll-smoothblock py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500">About</a>
  </li>
  <li>
    <a href="#contact" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500">Contact</a>
  </li>
</ul>

    </div>
  </div>
</nav>

        </header>

        <!-- Hero -->
        <main class="grid columns-2" style="background:#f9fafb;center;margin-top:3rem;gap:2rem; margin-bottom:3rem">
            <section id="home">
                <h1 style="font-size:4rem;line-height:1.05;font-weight:600;">Shop Sustainable, <br>Live Better</h1>
                <p class="muted" style="margin-top:.75rem;max-width:45ch;">
                    Discover eco-friendly products that make a positive impact on our planet. From zero‑waste essentials to sustainable fashion and home goods.
                </p>

                <div style="margin-top:1rem;display:flex;gap:.75rem;flex-wrap:wrap;">
                    <a href="#" class="button primary">Shop Now</a>
                    <a href="#" class="button ghost">Learn More</a>
                </div>

                <div style="display:flex;gap:1.25rem;margin-top:1rem;color:#6B7280;font-size:.9rem">
                    <div><strong>50k+</strong><div class="muted">Happy Customers</div></div>
                    <div><strong>95%</strong><div class="muted">Satisfaction</div></div>
                    <div><strong>1M+</strong><div class="muted">Products Delivered</div></div>
                </div>
            </section>

            <section>
                <div style="border-radius:10px;overflow:hidden;border:1px solid #E5E7EB;background:#fff;height:320px;display:flex;align-items:center;justify-content:center;">
                    @if(!empty($products) && isset($products[0]['image']))
                        <img src="{{ $products[0]['image'] }}" alt="hero product mockup" style="width:100%;height:100%;object-fit:cover;object-position:center"/>
                    @else
                        <img src="https://images.unsplash.com/photo-1542444459-db3d6f1e6e9f?q=80&w=1200&auto=format&fit=crop" alt="hero product mockup" style="width:100%;height:100%;object-fit:cover;object-position:center"/>
                    @endif
                </div>
            </section>
        </main>

        <!-- Categories -->

        <section id="shop" style="background:#ffffff;margin-top:3rem;">
            <h3 style="text-align:center;color:#000000;font-size:2rem;font-weight:600">Shop by Category</h3>
            <p style="text-align:center;color:#9CA3AF;margin-top:.5rem">Explore our curated collection of sustainable products.</p>

            <div class="grid columns-4" style="grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:2rem;min-width:200px; margin-bottom: 2rem;">
                @forelse($categories as $cat)
                    <div class="card" style="text-align:center">
                        <div style="font-size:1.75rem; height: 10rem; background: #e5e7eb" ></div>
                        <div style="font-weight:600;margin-top:.5rem">{{ ucwords(str_replace('-', ' ', $cat)) }}</div>
                        <div class="muted" style="margin-top:.5rem;font-size:.85rem">Products from <br>{{ ucwords(str_replace('-', ' ', $cat)) }}</div>
                    </div>
                @empty
                    <div class="card" style="text-align:center;">
                        <div style="font-weight:600">General</div>
                        <div class="muted" style="margin-top:.5rem;font-size:.85rem">Browse our featured items</div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Featured Products -->
        <section id="blog" style="background:#f9fafb;margin-top:2rem; margin-bottom:2rem;">
            <h3 style="text-align:center;font-size:2rem;font-weight:600">Featured Products</h3>
            <p style="text-align:center;color:#9CA3AF;margin-top:.25rem">Our most popular eco-friendly items</p>

            <div class="grid columns-3" style="grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:1rem">
                @forelse($products as $p)
                    <div class="card">
                        <img src="{{ $p['image'] ?? 'https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $p['title'] ?? 'Product' }}" style="width:100%;height:160px;object-fit:cover;border-radius:10px" />
                        <h4 style="margin-top:.75rem;font-weight:600">{{ \Illuminate\Support\Str::limit($p['title'] ?? 'Product', 60) }}</h4>
                        <div class="muted" style="margin-top:.25rem">
                            @if(isset($p['price'])) ${{ number_format($p['price'], 2) }} @else Contact for price @endif
                        </div>
                        <div style="margin-top:.5rem;display:flex;justify-content:space-between;align-items:center">
                            <a href="#" style="background:#0F172A;color:#fff;padding:.45rem .65rem;border-radius:6px;text-decoration:none;font-size:.85rem">Add to Cart</a>
                            <span style="font-size:.8rem;color:#9CA3AF">{{ $p['category'] ?? '' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="card">No products available.</div>
                @endforelse
            </div>
        </section>

        <!-- Assistant / Contact -->
<section id="assistant" class="mt-8 bg-gray-50 rounded-lg p-6">
  <div class="flex flex-col md:flex-row gap-8 items-start">

    <!-- Left Side -->
    <div class="flex-1 md:max-w-[70%]">
      <h2 class="text-2xl font-semibold">Meet Your Eco Shopping Assistant</h2>
      <p class="text-gray-600 mt-2">
        Our AI-powered chatbot helps you find the perfect sustainable products based on your lifestyle and preferences.
      </p>

      <ul class="mt-4 space-y-2 text-gray-700">
        <li class="flex items-center gap-2">
          <span class="text-green-600">✔</span> Personalized product recommendations
        </li>
        <li class="flex items-center gap-2">
          <span class="text-green-600">✔</span> Eco-impact comparisons
        </li>
        <li class="flex items-center gap-2">
          <span class="text-green-600">✔</span> Sustainability tips and advice
        </li>
      </ul>

      <button type="button"
        class="mt-5 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300
               font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:hover:bg-gray-700">
        Start Chatting
      </button>
    </div>

    <!-- Right Side (Chat UI) -->
    <div class="flex-1 md:max-w-[30%] border border-gray-200 rounded-xl shadow p-4 bg-white">
      <div class="space-y-3 text-sm">

        <!-- Chat bubble assistant -->
        <div class="bg-gray-100 p-3 rounded-lg">
          <p class="font-medium">🤖 Hi! I'm your eco shopping assistant. What kind of sustainable products are you looking for today?</p>
        </div>

        <!-- Chat bubble user -->
        <div class="bg-green-50 p-3 rounded-lg self-end">
          <p>I'm looking for eco-friendly clothing for teenagers</p>
        </div>

        <!-- Chat bubble assistant -->
        <div class="bg-gray-100 p-3 rounded-lg">
          <p>Great choice! I recommend checking out our organic cotton t-shirts and recycled denim collection. They're perfect for teens and have a 90%+ eco score!</p>
        </div>
      </div>

      <!-- Input -->
      <div class="mt-4 flex gap-2">
        <input type="text" placeholder="Type your message..."
          class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-200" />
        <button class="bg-black text-white px-3 py-2 rounded-lg hover:bg-gray-800">➤</button>
      </div>
    </div>

  </div>
</section>




        <!-- Testimonials -->
        <section style="margin-top:2rem;">
            <h4 style="text-align:center;font-weight:600">What Our Customers Say</h4>
            <div class="grid columns-3" style="grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:1rem">
                @forelse($testimonials as $t)
                    <div class="card">
                        <div style="display:flex;gap:.75rem;align-items:flex-start">
                            <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" style="width:44px;height:44px;border-radius:999px;object-fit:cover">
                            <div>
                                <div style="font-weight:600">{{ $t['name'] }}</div>
                                <p class="muted" style="margin-top:.4rem">{{ $t['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">No testimonials yet.</div>
                @endforelse
            </div>
        </section>

        <!-- CTA -->
        <section id="contact" style="margin-top:2rem;margin-bottom:2rem;">
            <div style="background:#0F172A;color:#fff;border-radius:10px;padding:1.25rem;text-align:center;">
                <h3 style="margin:0;font-size:1.125rem;font-weight:600">Ready to Make a Difference?</h3>
                <p class="muted" style="color:#E5E7EB;margin-top:.5rem">Join our community of eco-conscious shoppers and start your sustainable journey today.</p>
                <div style="margin-top:.75rem;display:flex;justify-content:center;gap:.75rem">
                    <a href="#" class="button" style="background:#fff;color:#0F172A">Start Shopping</a>
                    <a href="#" class="button" style="border:1px solid rgba(255,255,255,.3);color:#fff">Learn More</a>
                </div>
            </div>
        </section>

        <footer style="text-align:center;color:#9CA3AF;padding:1rem 0;border-top:1px solid #E5E7EB;">
            <div style="max-width:1100px;margin:0 auto;padding:0 1rem;display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap;">
                <div>&copy; EcoMart — Sustainable Store</div>
                <div class="muted">Laravel v{{ Illuminate\Foundation\Application::VERSION }} · PHP v{{ PHP_VERSION }}</div>
            </div>
        </footer>
    </div>
</body>
</html>
