<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($settings['org_name'] ?? 'Parlemen IKKB'))</title>
    <meta name="description" content="{{ $settings['org_name'] ?? 'IKKB' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --blue-deep:   #0a1a4a;
            --blue-main:   #1a3a8f;
            --blue-mid:    #2355c9;
            --blue-light:  #4a7de8;
            --blue-pale:   #dce9ff;
            --gold:        #d4a843;
            --gold-light:  #f0c96a;
            --white:       #ffffff;
            --gray-50:     #f8fafc;
            --gray-100:    #f1f5f9;
            --gray-200:    #e2e8f0;
            --gray-600:    #475569;
            --gray-800:    #1e293b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: var(--gray-800); background: var(--white); overflow-x: hidden; }

        /* ── NAVBAR ── */
        .navbar { position: fixed; top: 0; width: 100%; z-index: 1000; background: rgba(10, 26, 74, 0.95); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.1); padding: 0.9rem 0; transition: all 0.3s ease; }
        .navbar.scrolled { padding: 0.6rem 0; box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
        .nav-container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; }
        .nav-logo { color: white; font-size: 1.15rem; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; }
        .nav-logo span.italic-logo { font-family: 'Dancing Script', cursive; font-size: 1.3rem; color: var(--gold-light); }
        .nav-menu { display: flex; align-items: center; gap: 0.2rem; list-style: none; }
        .nav-menu a { color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.88rem; font-weight: 500; padding: 0.5rem 0.9rem; border-radius: 6px; transition: all 0.2s; }
        .nav-menu a:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 4px; }
        .nav-hamburger span { display: block; width: 25px; height: 2px; background: white; border-radius: 2px; transition: all 0.3s; }

        /* Footer */
        .footer { background: var(--blue-deep); color: rgba(255,255,255,0.6); text-align: center; padding: 1.5rem; font-size: 0.82rem; border-top: 1px solid rgba(255,255,255,0.1); }
        .footer a { color: var(--gold-light); text-decoration: none; }

        @media (max-width: 768px) {
            .nav-menu { display: none; position: absolute; top: 100%; left: 0; right: 0; background: var(--blue-deep); flex-direction: column; padding: 1rem; border-top: 1px solid rgba(255,255,255,0.1); }
            .nav-menu.open { display: flex; }
            .nav-hamburger { display: flex; }
        }
    </style>
    @yield('extra-css')
</head>
<body>

<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="nav-logo">
            @if(!empty($settings['org_logo']))
                <img src="{{ asset('storage/' . $settings['org_logo']) }}" alt="Logo" style="max-height: 45px; width: auto;">
            @else
                <span class="italic-logo">{{ $settings['navbar_logo'] ?? 'Parlemen' }}</span>
            @endif
        </a>
        <ul class="nav-menu" id="nav-menu">
            <li><a href="{{ route('home') }}#beranda">Beranda</a></li>
            <li><a href="{{ route('home') }}#sambutan">Sambutan</a></li>
            <li><a href="{{ route('home') }}#visi-misi">Visi &amp; Misi</a></li>
            <li><a href="{{ route('home') }}#pengurus">Pengurus</a></li>
            <li><a href="{{ route('home') }}#acara">Acara</a></li>
            <li><a href="{{ route('home') }}#berita">Berita</a></li>
        </ul>
        <div class="nav-hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>
    </div>
</nav>

<div class="main-content">
    @yield('content')
</div>

<footer class="footer">
    <p>{{ $settings['footer_text'] ?? '© 2025 Parlemen CAKRA ABHIPRAYA. All rights reserved.' }}</p>
    <p style="margin-top:0.3rem; font-size:0.75rem;">Website dikelola oleh Tim Admin &mdash; <a href="{{ route('admin.login') }}">Admin Panel</a></p>
</footer>

<script>
    window.addEventListener('scroll', () => { document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50); });
    function toggleMenu() { document.getElementById('nav-menu').classList.toggle('open'); }
    document.querySelectorAll('.nav-menu a').forEach(link => { link.addEventListener('click', () => { document.getElementById('nav-menu').classList.remove('open'); }); });
</script>
@yield('extra-js')
</body>
</html>
