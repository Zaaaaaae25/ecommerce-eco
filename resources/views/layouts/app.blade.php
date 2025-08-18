<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EcoMart</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            html,body{font-family:Figtree,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#F9FAFB;color:#0F172A;margin:0}
            .container{max-width:1100px;margin:0 auto;padding:1rem}
            .card{background:#fff;border:1px solid #E5E7EB;border-radius:8px;padding:1rem}
            .muted{color:#6B7280}
            header{background:#fff;border-bottom:1px solid #E5E7EB}
            .nav-links a{margin:0 .5rem;color:#6B7280;text-decoration:none;font-size:0.95rem}
            .nav-icons img, .nav-icons svg{vertical-align:middle}
        </style>
    @endif

    @stack('styles')
</head>
<body class="antialiased">
    <header>
        <div class="container" style="display:flex;align-items:center;justify-content:space-between;padding:.6rem 0;">
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.6rem;text-decoration:none;color:inherit">
                <span style="width:36px;height:36px;border-radius:6px;background:#F3F4F6;display:inline-flex;align-items:center;justify-content:center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="color:#16A34A"><path d="M12 2C7 2 4 7 4 11.5S7 21 12 21s8-4.5 8-9.5S17 2 12 2z"/></svg>
                </span>
                <strong style="font-size:1rem">EcoMart</strong>
            </a>

            <nav class="nav-links" style="display:none;align-items:center;">
                <a href="#">Home</a>
                <a href="#">Shop</a>
                <a href="#">Blog</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
            </nav>

            <div style="display:flex;align-items:center;gap:.5rem" class="nav-icons">
                <form action="#" method="GET" style="display:flex;align-items:center;border:1px solid #E5E7EB;border-radius:999px;padding:4px 6px;background:#fff;display:none">
                    <input name="q" type="search" placeholder="Search eco products..." style="border:none;outline:none;padding:4px 6px;font-size:.9rem" />
                    <button type="submit" style="background:transparent;border:none;padding:4px;color:#6B7280">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                    </button>
                </form>

                <a href="#" style="padding:6px;border-radius:6px;color:#6B7280">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318A4.5 4.5 0 0112 7.5a4.5 4.5 0 017.682-.182 4.5 4.5 0 01-1.364 6.686L12 21 5.682 14.682A4.5 4.5 0 014.318 6.318z"/></svg>
                </a>

                <a href="#" style="position:relative;padding:6px;border-radius:6px;color:#6B7280">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6.4A1 1 0 007 21h10a1 1 0 00.98-.804L19 13"/></svg>
                    <span style="position:absolute;top:-6px;right:-6px;background:#111;color:#fff;border-radius:999px;font-size:10px;padding:3px 5px">3</span>
                </a>

                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"><img src="{{ Auth::user()->profile_image ?? 'https://images.unsplash.com/photo-1607746882042-944635dfe10e?q=80&w=64&auto=format&fit=crop' }}" alt="avatar" style="width:34px;height:34px;border-radius:999px;object-fit:cover;border:1px solid #EEF2F7"></a>
                        @else
                            <a href="{{ route('login') }}" style="font-size:.95rem;color:#374151">Log in</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container" style="padding-top:1rem">
            @yield('content')
        </div>
