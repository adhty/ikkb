<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Parlemen Admin IKKB</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --blue-deep:  #0a1a4a;
            --blue-main:  #1a3a8f;
            --blue-mid:   #2355c9;
            --blue-light: #4a7de8;
            --blue-pale:  #dce9ff;
            --gold:       #d4a843;
            --gold-light: #f0c96a;
            --white:      #ffffff;
            --gray-50:    #f8fafc;
            --gray-100:   #f1f5f9;
            --gray-200:   #e2e8f0;
            --gray-500:   #64748b;
            --gray-700:   #334155;
            --sidebar-w:  260px;
            --success:    #22c55e;
            --danger:     #ef4444;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:var(--gray-50); color:var(--gray-700); display:flex; min-height:100vh; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(180deg, var(--blue-deep) 0%, var(--blue-main) 100%);
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand .script { font-family:'Dancing Script',cursive; color:rgba(255,255,255,0.8); font-size:1rem; }
        .sidebar-brand h2 { color:white; font-size:1rem; font-weight:800; letter-spacing:-0.02em; }
        .sidebar-brand .badge {
            display:inline-block;
            background:rgba(212,168,67,0.2);
            border:1px solid rgba(212,168,67,0.4);
            color:#f0c96a;
            font-size:0.65rem;
            font-weight:700;
            letter-spacing:0.1em;
            padding:0.15rem 0.5rem;
            border-radius:100px;
            margin-top:0.4rem;
        }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .sidebar-section {
            padding: 0.4rem 1rem 0.2rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            margin-top: 0.75rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.5rem;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: white;
            background: rgba(255,255,255,0.08);
            border-left-color: var(--gold-light);
        }
        .sidebar-link i { width: 18px; text-align: center; font-size: 0.85rem; }
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-user { color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-bottom: 0.75rem; }
        .sidebar-user strong { color: white; display: block; font-size: 0.85rem; }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s;
            width: 100%;
            background: none;
            border: 1px solid rgba(255,255,255,0.15);
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }
        .btn-logout:hover { background: rgba(239,68,68,0.15); border-color: rgba(239,68,68,0.4); color: #fca5a5; }

        /* Main content */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .topbar {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar h1 { font-size: 1.1rem; font-weight: 700; color: var(--blue-deep); }
        .topbar .breadcrumb { font-size: 0.78rem; color: var(--gray-500); margin-top: 0.15rem; }
        .page-content { padding: 2rem; flex: 1; }

        /* Alerts */
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }

        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            margin-bottom: 1.5rem;
        }
        .card-title { font-size: 0.95rem; font-weight: 700; color: var(--blue-deep); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; }

        /* Form elements */
        .form-row { display: grid; gap: 1.2rem; margin-bottom: 1.2rem; }
        .form-row.cols-2 { grid-template-columns: 1fr 1fr; }
        .form-group label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--gray-700); margin-bottom: 0.4rem; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            padding: 0.7rem 0.9rem;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            color: var(--gray-700);
            outline: none;
            transition: border-color 0.2s;
            background: white;
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color: var(--blue-mid); }
        .form-group textarea { resize: vertical; min-height: 100px; }
        .form-hint { font-size: 0.75rem; color: var(--gray-500); margin-top: 0.3rem; }

        /* Photo preview */
        .photo-preview-wrap { margin-top: 0.5rem; }
        .photo-preview-wrap img { max-width: 150px; border-radius: 10px; border: 2px solid var(--gray-200); }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.2rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; cursor: pointer; border: none; font-family: 'Inter', sans-serif; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background: linear-gradient(135deg, var(--blue-mid), var(--blue-light)); color: white; }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(35,85,201,0.3); }
        .btn-danger  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .btn-danger:hover { background: #dc2626; color: white; }
        .btn-secondary { background: var(--gray-100); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-200); }
        .btn-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
        .btn-success:hover { background: #16a34a; color: white; }

        /* Table */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--gray-50); padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gray-500); border-bottom: 1px solid var(--gray-200); }
        td { padding: 0.85rem 1rem; border-bottom: 1px solid var(--gray-100); font-size: 0.875rem; vertical-align: middle; }
        tr:hover td { background: var(--gray-50); }
        .td-actions { display: flex; gap: 0.5rem; align-items: center; }

        /* Member avatar in table */
        .tbl-avatar { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--blue-pale); }
        .badge-type { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 100px; font-size: 0.72rem; font-weight: 600; }
        .badge-harian { background: #eff6ff; color: #1d4ed8; }
        .badge-komisi { background: #faf5ff; color: #7c3aed; }

        /* Stats cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
        .stat-icon.blue  { background: #eff6ff; color: var(--blue-mid); }
        .stat-icon.gold  { background: #fffbeb; color: var(--gold); }
        .stat-icon.green { background: #f0fdf4; color: #16a34a; }
        .stat-info h3 { font-size: 1.75rem; font-weight: 800; color: var(--blue-deep); }
        .stat-info p  { font-size: 0.78rem; color: var(--gray-500); }

        /* Quick links */
        .quick-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; }
        .quick-card { background: white; border-radius: 14px; padding: 1.25rem; border: 1px solid var(--gray-200); text-decoration: none; color: inherit; transition: all 0.2s; display: flex; align-items: center; gap: 0.85rem; }
        .quick-card:hover { border-color: var(--blue-light); box-shadow: 0 4px 12px rgba(35,85,201,0.1); transform: translateY(-2px); }
        .quick-card i { font-size: 1.2rem; color: var(--blue-mid); }
        .quick-card h4 { font-size: 0.85rem; font-weight: 600; color: var(--blue-deep); }
        .quick-card p { font-size: 0.75rem; color: var(--gray-500); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .form-row.cols-2 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        @if(!empty($settings['org_logo']))
            <div style="margin-bottom: 0.8rem;">
                <img src="{{ asset('storage/' . $settings['org_logo']) }}" alt="Logo" style="max-height: 50px; width: auto; display: block;">
            </div>
        @else
            <div class="script">Parlemen</div>
            <h2>IKKB</h2>
        @endif
        <div class="badge"><i class="fas fa-shield-halved"></i> ADMIN PANEL</div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i class="fas fa-external-link-alt"></i> Lihat Website
        </a>

        <div class="sidebar-section">Konten</div>
        <a href="{{ route('admin.settings.hero') }}" class="sidebar-link {{ request()->routeIs('admin.settings.hero*') ? 'active' : '' }}">
            <i class="fas fa-image"></i> Hero Section
        </a>
        <a href="{{ route('admin.settings.visi-misi') }}" class="sidebar-link {{ request()->routeIs('admin.settings.visi-misi*') ? 'active' : '' }}">
            <i class="fas fa-scroll"></i> Visi &amp; Misi
        </a>
        <a href="{{ route('admin.settings.sambutan') }}" class="sidebar-link {{ request()->routeIs('admin.settings.sambutan*') ? 'active' : '' }}">
            <i class="fas fa-comment-dots"></i> Sambutan Ketua
        </a>
        <a href="{{ route('admin.settings.pengurus-photo') }}" class="sidebar-link {{ request()->routeIs('admin.settings.pengurus-photo*') ? 'active' : '' }}">
            <i class="fas fa-camera"></i> Foto Pengurus
        </a>
        <a href="{{ route('admin.galleries.index') }}" class="sidebar-link {{ request()->routeIs('admin.galleries*') ? 'active' : '' }}">
            <i class="fas fa-images"></i> Galeri Slider
        </a>
        <a href="{{ route('admin.settings.general') }}" class="sidebar-link {{ request()->routeIs('admin.settings.general*') ? 'active' : '' }}">
            <i class="fas fa-sliders"></i> Pengaturan Umum
        </a>

        <div class="sidebar-section">Organisasi & Konten</div>
        <a href="{{ route('admin.members.index') }}" class="sidebar-link {{ request()->routeIs('admin.members*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Anggota / Pengurus
        </a>
        <a href="{{ route('admin.commissions.index') }}" class="sidebar-link {{ request()->routeIs('admin.commissions*') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i> Komisi
        </a>
        <a href="{{ route('admin.articles.index') }}" class="sidebar-link {{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Berita & Angket
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <strong>{{ auth()->user()->name }}</strong>
            {{ auth()->user()->email }}
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Main -->
<div class="main">
    <div class="topbar">
        <div>
            <h1>@yield('page-title', 'Dashboard')</h1>
            <div class="breadcrumb">@yield('breadcrumb', 'Admin / Dashboard')</div>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary" style="font-size:0.78rem; padding:0.45rem 0.9rem;">
            <i class="fas fa-external-link-alt"></i> Lihat Website
        </a>
    </div>

    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>
</body>
</html>
