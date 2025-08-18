<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EcoMart — Sustainable Store</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
            <div style="display:flex;align-items:center;gap:1rem;">
                <img src="https://images.unsplash.com/photo-1515018051890-51e0a0d7b1f6?q=80&w=80&auto=format&fit=crop" alt="EcoMart logo" style="width:40px;height:40px;border-radius:6px;object-fit:cover"/>
                <div style="font-weight:600">EcoMart</div>
            </div>

            <nav style="display:flex;gap:1rem;align-items:center;">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="muted">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="muted">Log in</a>
                    @endauth
                @endif
            </nav>
        </header>

        <!-- Hero -->
        <main class="grid columns-2" style="align-items:center;margin-top:1.5rem;gap:2rem;">
            <section>
                <h1 style="font-size:2.25rem;line-height:1.05;font-weight:600;">Shop Sustainable, Live Better</h1>
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
                    <img src="https://images.unsplash.com/photo-1542444459-db3d6f1e6e9f?q=80&w=1200&auto=format&fit=crop" alt="hero product mockup" style="width:100%;height:100%;object-fit:cover;object-position:center"/>
                </div>
            </section>
        </main>

        <!-- Categories -->
        <section style="margin-top:2.25rem;">
            <h3 style="text-align:center;color:#6B7280">Shop by Category</h3>
            <p style="text-align:center;color:#9CA3AF;margin-top:.25rem">Explore our curated collection of sustainable products.</p>

            <div class="grid columns-4" style="grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:1rem">
                <div class="card" style="text-align:center">
                    <div style="font-size:1.75rem">👕</div>
                    <div style="font-weight:600;margin-top:.5rem">Eco Fashion</div>
                    <div class="muted" style="margin-top:.5rem;font-size:.85rem">Sustainable clothing & accessories</div>
                </div>
                <div class="card" style="text-align:center">
                    <div style="font-size:1.75rem">🏠</div>
                    <div style="font-weight:600;margin-top:.5rem">Home & Living</div>
                    <div class="muted" style="margin-top:.5rem;font-size:.85rem">Zero‑waste home essentials</div>
                </div>
                <div class="card" style="text-align:center">
                    <div style="font-size:1.75rem">🍃</div>
                    <div style="font-weight:600;margin-top:.5rem">Handmade</div>
                    <div class="muted" style="margin-top:.5rem;font-size:.85rem">Artisan products & gifts</div>
                </div>
                <div class="card" style="text-align:center">
                    <div style="font-size:1.75rem">⚡</div>
                    <div style="font-weight:600;margin-top:.5rem">Zero Waste</div>
                    <div class="muted" style="margin-top:.5rem;font-size:.85rem">Refillable & reusable items</div>
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section style="margin-top:2rem;">
            <h3 style="text-align:center;font-size:1.125rem;font-weight:600">Featured Products</h3>
            <p style="text-align:center;color:#9CA3AF;margin-top:.25rem">Our most popular eco-friendly items</p>

            <div class="grid columns-3" style="grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:1rem">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=800&auto=format&fit=crop" alt="reusable bottle" style="width:100%;height:160px;object-fit:cover;border-radius:6px" />
                    <h4 style="margin-top:.75rem;font-weight:600">Reusable Water Bottle</h4>
                    <div class="muted" style="margin-top:.25rem">$24.99</div>
                </div>

                <div class="card">
                    <img src="https://images.unsplash.com/photo-1602810316122-1b6cbee5f3fb?q=80&w=800&auto=format&fit=crop" alt="cotton tote" style="width:100%;height:160px;object-fit:cover;border-radius:6px" />
                    <h4 style="margin-top:.75rem;font-weight:600">Organic Cotton Tote</h4>
                    <div class="muted" style="margin-top:.25rem">$15.99</div>
                </div>

                <div class="card">
                    <img src="https://images.unsplash.com/photo-1585238342029-1c3d1f8e6b2a?q=80&w=800&auto=format&fit=crop" alt="bamboo toothbrush" style="width:100%;height:160px;object-fit:cover;border-radius:6px" />
                    <h4 style="margin-top:.75rem;font-weight:600">Bamboo Toothbrush Set</h4>
                    <div class="muted" style="margin-top:.25rem">$12.99</div>
                </div>
            </div>
        </section>

        <!-- Assistant / Contact -->
        <section style="margin-top:2rem;">
            <div class="card" style="display:flex;gap:1rem;align-items:flex-start;flex-wrap:wrap;">
                <div style="flex:1;">
                    <h4 style="font-weight:600">Meet Your Eco Shopping Assistant</h4>
                    <p class="muted" style="margin-top:.5rem">Personalized recommendations, sustainability tips, and help finding the right items.</p>
                    <a href="#" class="button primary" style="margin-top:.75rem">Start Chatting</a>
                </div>

                <div style="width:260px;">
                    <label class="muted" style="font-size:.85rem">Ask a question</label>
                    <div style="margin-top:.5rem;display:flex;gap:.5rem">
                        <input type="text" placeholder="Type your message..." style="flex:1;padding:.5rem;border:1px solid #E5E7EB;border-radius:6px" />
                        <button class="primary" style="padding:.5rem;border-radius:6px;border:none;background:#0F172A;color:#fff">Send</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section style="margin-top:2rem;">
            <h4 style="text-align:center;font-weight:600">What Our Customers Say</h4>
            <div class="grid columns-3" style="grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:1rem">
                <div class="card">
                    <div style="font-weight:600">Rina A.</div>
                    <p class="muted" style="margin-top:.5rem">Produk berkualitas dan ramah lingkungan. Sangat puas!</p>
                </div>
                <div class="card">
                    <div style="font-weight:600">Andi S.</div>
                    <p class="muted" style="margin-top:.5rem">Pelayanan cepat dan pengemasan minimal plastik.</p>
                </div>
                <div class="card">
                    <div style="font-weight:600">Maya C.</div>
                    <p class="muted" style="margin-top:.5rem">Rekomendasi produk sangat membantu.</p>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section style="margin-top:2rem;margin-bottom:2rem;">
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
