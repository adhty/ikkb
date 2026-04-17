@extends('layouts.app')

@section('title', ($settings['org_name'] ?? 'Parlemen CAKRA ABHIPRAYA') . ' - ' . ($settings['org_periode'] ?? '2025'))

@section('extra-css')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* ── HERO ── */
        .hero { min-height: 100vh; position: relative; overflow: hidden; margin-top: 0; padding-top: 0; }
        .hero-swiper { width: 100%; height: 100vh; margin-top: 0; }
        .hero-slide { position: relative; display: flex; align-items: center; justify-content: center; }
        .hero-bg-image { position: absolute; inset: 0; background-size: cover; background-position: center; background-repeat: no-repeat; }
        .hero-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,26,74,0.92) 0%, rgba(26,58,143,0.8) 60%, rgba(35,85,201,0.7) 100%); }
        .hero-particles { position: absolute; inset: 0; overflow: hidden; z-index: 1; }
        
        .swiper-button-next, .swiper-button-prev { color: white !important; opacity: 0.5; transition: opacity 0.3s; }
        .swiper-button-next:hover, .swiper-button-prev:hover { opacity: 1; }
        .swiper-pagination-bullet { background: white !important; opacity: 0.5; }
        .swiper-pagination-bullet-active { opacity: 1; }

        .particle { position: absolute; width: 3px; height: 3px; background: rgba(255,255,255,0.4); border-radius: 50%; animation: float-particle linear infinite; }
        @keyframes float-particle { 0% { transform: translateY(100vh) rotate(0deg); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; } }
        
        .hero-content { position: absolute; top: 50%; left: 0; right: 0; transform: translateY(-50%); z-index: 999; text-align: center; padding: 2rem; pointer-events: none; }
        .hero-content * { pointer-events: auto; }
        .hero-tag { display: inline-block; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: var(--gold-light); font-size: 0.8rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; padding: 0.4rem 1.2rem; border-radius: 100px; margin-bottom: 1.5rem; backdrop-filter: blur(8px); }
        .hero-title-italic { font-family: 'Dancing Script', cursive; color: rgba(255,255,255,0.9); font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 400; line-height: 1.1; margin-bottom: 0.2rem; text-shadow: 0 2px 20px rgba(0,0,0,0.3); }
        .hero-title-main { font-family: 'Inter', sans-serif; color: var(--white); font-size: clamp(2.5rem, 7vw, 5.5rem); font-weight: 900; letter-spacing: -0.02em; line-height: 0.95; text-shadow: 0 4px 30px rgba(0,0,0,0.4); margin-bottom: 1.5rem; }
        .hero-divider { width: 80px; height: 3px; background: linear-gradient(90deg, transparent, var(--gold), transparent); margin: 1rem auto; }
        .hero-tagline { color: rgba(255,255,255,0.75); font-size: clamp(0.9rem, 2vw, 1.1rem); font-weight: 400; max-width: 600px; margin: 0 auto 2.5rem; line-height: 1.7; }
        .hero-scroll { display: inline-flex; align-items: center; gap: 0.5rem; color: rgba(255,255,255,0.6); font-size: 0.85rem; text-decoration: none; transition: color 0.2s; animation: bounce-arrow 2s ease-in-out infinite; }
        .hero-scroll:hover { color: white; }
        @keyframes bounce-arrow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(6px); } }

        /* ── COMMON ── */
        section { padding: 6rem 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .section-label { display: inline-block; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: var(--blue-mid); margin-bottom: 0.75rem; }
        .section-title { font-family: 'Dancing Script', cursive; font-size: clamp(2.2rem, 5vw, 3.5rem); color: var(--blue-deep); margin-bottom: 0.5rem; text-decoration: underline; text-underline-offset: 6px; text-decoration-color: var(--blue-mid); }

        /* ── SAMBUTAN ── */
        .sambutan-section { background: white; padding: 6rem 0; }
        .sambutan-layout { display: grid; grid-template-columns: 350px 1fr; gap: 4rem; align-items: center; }
        .sambutan-photo { position: relative; }
        .sambutan-photo img { width: 100%; border-radius: 20px; box-shadow: 20px 20px 60px rgba(0,0,0,0.1); object-fit: cover; }
        .sambutan-text h3 { font-family: 'Dancing Script', cursive; font-size: 1.5rem; color: var(--gray-600); margin-bottom: 0.5rem; }
        .sambutan-text h2 { font-size: 2.2rem; font-weight: 800; color: var(--blue-deep); margin-bottom: 1.5rem; border-left: 5px solid var(--blue-mid); padding-left: 1.5rem; }
        .sambutan-content { font-size: 1rem; line-height: 1.8; color: var(--gray-600); white-space: pre-line; }
        .sambutan-signature { margin-top: 2rem; font-family: 'Dancing Script', cursive; font-size: 1.8rem; color: var(--blue-deep); }

        /* ── VISI MISI ── */
        .visi-misi-section { background: linear-gradient(180deg, var(--gray-50) 0%, var(--white) 40%, var(--blue-deep) 40%, var(--blue-main) 100%); }
        .vm-header { text-align: center; padding-bottom: 4rem; }
        .vm-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
        .vm-card { background: white; border-radius: 20px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(10,26,74,0.12); border-top: 4px solid var(--blue-mid); position: relative; overflow: hidden; }
        .vm-card-icon { width: 52px; height: 52px; background: linear-gradient(135deg, var(--blue-mid), var(--blue-light)); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.2rem; }
        .vm-card-icon i { color: white; font-size: 1.4rem; }
        .vm-card h3 { font-family: 'Dancing Script', cursive; font-size: 2rem; color: var(--blue-deep); margin-bottom: 1rem; }
        .vm-card p, .vm-card li { color: var(--gray-600); font-size: 0.9rem; line-height: 1.8; }
        .vm-card ol { padding-left: 1.2rem; }

        /* ── TAGLINE ── */
        .tagline-banner { background: var(--blue-deep); padding: 3rem 0; text-align: center; color: white; border-top: 4px solid var(--gold); }
        .tagline-banner h2 { font-size: 1.8rem; font-weight: 800; letter-spacing: 0.1em; }

        /* ── ANGKEPT ── */
        .angket-section { background: var(--gray-50); padding: 5rem 0; }
        .angket-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 3rem; }
        .angket-card { background: white; border-radius: 16px; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.05); transition: all 0.3s; border-bottom: 4px solid transparent; text-decoration: none; display: block; color: inherit; }
        .angket-card:hover { transform: translateY(-10px); border-bottom-color: var(--blue-mid); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .angket-icon { width: 100%; height: 180px; object-fit: contain; margin-bottom: 1.5rem; }
        .angket-card h4 { font-size: 1.1rem; font-weight: 700; color: var(--blue-deep); }

        /* ── PENGURUS ── */
        .pengurus-section { background: white; }
        .pengurus-inner { background: linear-gradient(135deg, var(--gray-50), var(--blue-pale)); border-radius: 24px; padding: 4rem; overflow: hidden; position: relative; }
        .pengurus-title { text-align: center; margin-bottom: 3rem; }
        .pengurus-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; }
        .pengurus-photo-wrap img { width: 100%; border-radius: 16px; box-shadow: 0 20px 60px rgba(10,26,74,0.2); display: block; object-fit: cover; min-height: 280px; }
        .pengurus-photo-placeholder { width: 100%; min-height: 280px; border-radius: 16px; background: linear-gradient(135deg, var(--blue-main), var(--blue-mid)); display: flex; align-items: center; justify-content: center; }
        .pengurus-members-grid { display: grid; gap: 1rem; }
        .pengurus-member-item { background: white; border-radius: 14px; padding: 1rem 1.4rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.06); transition: all 0.2s; }
        .member-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid var(--blue-pale); flex-shrink: 0; }
        .member-info h4 { font-size: 0.9rem; font-weight: 600; color: var(--blue-deep); }
        .member-info span { font-size: 0.78rem; color: var(--gray-600); }

        /* ── BERITA ── */
        .berita-section { background: white; padding: 5rem 0; }
        .berita-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; margin-top: 3rem; }
        .berita-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s; }
        .berita-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.1); }
        .berita-img { width: 100%; height: 220px; object-fit: cover; }
        .berita-body { padding: 1.5rem; }
        .berita-body h4 { font-size: 1.1rem; font-weight: 700; color: var(--blue-deep); margin-bottom: 0.75rem; }
        .berita-body p { font-size: 0.9rem; color: var(--gray-600); line-height: 1.6; margin-bottom: 1rem; }
        .btn-more { color: var(--blue-mid); font-weight: 700; text-decoration: none; font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem; }

        /* ── KOMISI ── */
        .komisi-section { background: linear-gradient(180deg, var(--blue-deep) 0%, var(--blue-main) 100%); padding-bottom: 8rem; }
        .komisi-section .section-label { color: var(--gold-light); }
        .komisi-section .section-title { color: white; text-decoration-color: var(--gold); }
        .komisi-block { margin-top: 3rem; }
        .komisi-header { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15); border-radius: 14px; padding: 1.2rem 2rem; margin-bottom: 1.5rem; backdrop-filter: blur(8px); }
        .komisi-header h3 { font-family: 'Dancing Script', cursive; font-size: 1.8rem; color: white; }
        .komisi-members-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1.2rem; }
        .komisi-member-card { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 1.5rem 1rem; text-align: center; transition: all 0.3s; backdrop-filter: blur(8px); }
        .komisi-member-photo { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid rgba(255,255,255,0.3); margin: 0 auto 0.75rem; display: block; }
        .komisi-member-name { font-size: 0.82rem; font-weight: 600; color: white; }
        .komisi-member-name { font-size: 0.82rem; font-weight: 600; color: white; }
        .komisi-member-pos { font-size: 0.72rem; color: rgba(255,255,255,0.6); }

        /* ── ACARA ── */
        .acara-section { background: var(--gray-50); padding: 5rem 0; }
        .acara-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 3rem; }
        .acara-card { background: white; border-radius: 20px; display: flex; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s; position: relative; border-left: 5px solid var(--blue-mid); }
        .acara-card:hover { transform: translateX(10px); box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .acara-date-box { background: var(--blue-deep); color: white; padding: 1rem; display: flex; flex-direction: column; align-items: center; justify-content: center; min-width: 80px; text-align: center; }
        .acara-date-box .day { font-size: 1.5rem; font-weight: 800; line-height: 1; }
        .acara-date-box .month { font-size: 0.7rem; text-transform: uppercase; font-weight: 600; opacity: 0.8; }
        .acara-img { width: 120px; height: 100%; object-fit: cover; flex-shrink: 0; }
        .acara-info { padding: 1.2rem; flex-grow: 1; }
        .acara-info h4 { font-size: 1.05rem; font-weight: 700; color: var(--blue-deep); margin-bottom: 0.4rem; line-height: 1.3; }
        .acara-info p { font-size: 0.85rem; color: var(--gray-600); line-height: 1.5; margin-bottom: 0.8rem; }
        .acara-link { font-size: 0.8rem; font-weight: 700; color: var(--blue-mid); text-decoration: none; display: flex; align-items: center; gap: 0.4rem; }

        /* ── ANIMATIONS ── */
        .fade-up { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        @media (max-width: 768px) {
            .sambutan-layout { grid-template-columns: 1fr; text-align: center; }
            .sambutan-text h2 { border-left: none; padding-left: 0; }
            .vm-cards { grid-template-columns: 1fr; }
            .pengurus-layout { grid-template-columns: 1fr; }
            .komisi-members-grid { grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); }
        }
    </style>
@endsection

@section('content')
<section class="hero" id="beranda">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            @forelse($galleries as $gallery)
                <div class="swiper-slide hero-slide">
                    <div class="hero-bg-image" style="background-image: url('{{ asset('storage/' . $gallery->image) }}')"></div>
                    <div class="hero-overlay"></div>
                </div>
            @empty
                <div class="swiper-slide hero-slide">
                    @if(!empty($settings['hero_image']))
                        <div class="hero-bg-image" style="background-image: url('{{ asset('storage/' . $settings['hero_image']) }}')"></div>
                    @else
                        <div class="hero-bg-image" style="background: linear-gradient(135deg, var(--blue-deep) 0%, var(--blue-main) 100%);"></div>
                    @endif
                    <div class="hero-overlay"></div>
                </div>
            @endforelse
        </div>
        
        @if($galleries->count() > 1)
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        @endif

        <div class="hero-particles" id="particles"></div>
    </div>

    <!-- Teks Statis di Depan Slider -->
    <div class="hero-content fade-up visible">
        <div class="hero-tag">
            <i class="fas fa-star"></i>
            {{ $settings['org_periode'] ?? '2025' }}
        </div>
        <div class="hero-title-italic">{{ $settings['hero_title'] ?? 'Foto IKKB' }}</div>
        <div class="hero-title-main">{{ $settings['hero_subtitle'] ?? 'IKKB' }}</div>
        <div class="hero-divider"></div>
        @if(!empty($settings['hero_tagline']))
            <p class="hero-tagline">{{ $settings['hero_tagline'] }}</p>
        @endif
        <a href="#sambutan" class="hero-scroll">
            <i class="fas fa-chevron-down"></i> Lihat Selengkapnya
        </a>
    </div>
</section>

<section class="sambutan-section" id="sambutan">
    <div class="container">
        <div class="sambutan-layout">
            <div class="sambutan-photo fade-up">
                @if(!empty($settings['sambutan_image']))
                    <img src="{{ asset('storage/' . $settings['sambutan_image']) }}" alt="Foto Ketua">
                @else
                    <div style="background:var(--gray-100); border-radius:20px; aspect-ratio:3/4; display:flex; align-items:center; justify-content:center;">
                        <i class="fas fa-user-tie" style="font-size:5rem; color:var(--gray-200)"></i>
                    </div>
                @endif
            </div>
            <div class="sambutan-text fade-up" style="transition-delay:0.1s">
                <h3>Sambutan oleh</h3>
                <h2>{{ $settings['sambutan_title'] ?? 'KETUA IKKB' }}</h2>
                <div class="sambutan-content">{{ $settings['sambutan_content'] ?? '' }}</div>
                <div class="sambutan-signature">{{ $settings['sambutan_name'] ?? '' }}</div>
            </div>
        </div>
    </div>
</section>

<section class="visi-misi-section" id="visi-misi">
    <div class="container">
        <div class="vm-header fade-up">
            <span class="section-label">Landasan Organisasi</span>
            <div class="section-title">{{ $settings['visi_title'] ?? 'Visi & Misi' }}</div>
        </div>
        <div class="vm-cards">
            <div class="vm-card fade-up">
                <div class="vm-card-icon"><i class="fas fa-eye"></i></div>
                <h3>Visi</h3>
                <p>{{ $settings['visi_content'] ?? '' }}</p>
            </div>
            <div class="vm-card fade-up" style="transition-delay:0.15s">
                <div class="vm-card-icon"><i class="fas fa-bullseye"></i></div>
                <h3>Misi</h3>
                <ol>
                    @foreach(array_filter(explode("\n", $settings['misi_content'] ?? '')) as $misi)
                        <li>{{ trim($misi) }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="tagline-banner fade-up">
    <div class="container">
        <h2>{{ $settings['org_tagline'] ?? 'BERSAMA SEMA MAJU, VIVA LEGISLATIF!' }}</h2>
    </div>
</div>

<section class="angket-section" id="angket">
    <div class="container">
        <div class="fade-up" style="text-align:center">
            <span class="section-label">Layanan Mahasiswa</span>
            <div class="section-title">Angket & Layanan</div>
        </div>
        <div class="angket-grid">
            @forelse($angket as $item)
                <a href="{{ $item->link }}" target="_blank" class="angket-card fade-up">
                    <img src="{{ $item->image ? asset('storage/'.$item->image) : '' }}" 
                         alt="{{ $item->title }}" 
                         class="angket-icon"
                         style="{{ !$item->image ? 'display:none' : '' }}">
                    @if(!$item->image)
                        <div class="angket-icon" style="background:var(--blue-pale); display:flex; align-items:center; justify-content:center; border-radius:12px; margin-bottom:1.5rem; height:180px;">
                            <i class="fas fa-link" style="font-size:3rem; color:var(--blue-mid)"></i>
                        </div>
                    @endif
                    <h4>{{ $item->title }}</h4>
                </a>
            @empty
                <p style="text-align:center; color:var(--gray-500); grid-column:1/-1;">Belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="pengurus-section" id="pengurus">
    <div class="container">
        <div class="pengurus-inner">
            <div class="pengurus-title fade-up">
                <span class="section-label">Struktur Organisasi</span>
                <div class="section-title">Pengurus Harian</div>
            </div>
            <div class="pengurus-layout">
                <div class="pengurus-photo-wrap fade-up">
                    @if(!empty($settings['pengurus_harian_photo']))
                        <img src="{{ asset('storage/' . $settings['pengurus_harian_photo']) }}" alt="Pengurus Harian">
                    @else
                        <div class="pengurus-photo-placeholder"><i class="fas fa-users" style="color:white; font-size:4rem"></i></div>
                    @endif
                </div>
                <div class="pengurus-members-grid fade-up" style="transition-delay:0.1s">
                    @forelse($pengurusHarian as $member)
                        <div class="pengurus-member-item">
                            @if($member->photo)
                                <img class="member-avatar" src="{{ $member->photo_url }}" alt="{{ $member->name }}">
                            @else
                                <div class="member-avatar" style="background:var(--blue-pale); display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-user" style="color:var(--blue-mid); font-size:1rem"></i>
                                </div>
                            @endif
                            <div class="member-info">
                                <h4>{{ $member->name }}</h4>
                                <span>{{ $member->position }}</span>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--gray-600); grid-column: 1/-1; text-align: center;">Belum ada data pengurus.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<section class="acara-section" id="acara">
    <div class="container">
        <div class="fade-up">
            <span class="section-label">Agenda Organisasi</span>
            <div class="section-title">Acara & Kegiatan</div>
        </div>
        <div class="acara-grid">
            @forelse($acara as $item)
                <div class="acara-card fade-up">
                    <div class="acara-date-box">
                        <span class="day">{{ $item->created_at->format('d') }}</span>
                        <span class="month">{{ $item->created_at->format('M') }}</span>
                    </div>
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="acara-img">
                    @endif
                    <div class="acara-info">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ Str::limit($item->content, 80) }}</p>
                        <a href="{{ route('article.show', $item->id) }}" class="acara-link">Detail Acara <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            @empty
                <p style="text-align:center; color:var(--gray-500); grid-column:1/-1;">Belum ada agenda kegiatan terdekat.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="berita-section" id="berita">
    <div class="container">
        <div class="fade-up">
            <span class="section-label">Warta Kampus</span>
            <div class="section-title">Berita Terkini</div>
        </div>
        <div class="berita-grid">
            @forelse($berita as $item)
                <div class="berita-card fade-up">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="berita-img">
                    @else
                        <div class="berita-img" style="background:var(--blue-pale); display:flex; align-items:center; justify-content:center; height:220px;">
                            <i class="fas fa-newspaper" style="font-size:4rem; color:var(--blue-mid)"></i>
                        </div>
                    @endif
                    <div class="berita-body">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ Str::limit($item->content, 120) }}</p>
                        <a href="{{ route('article.show', $item->id) }}" class="btn-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <p style="text-align:center; color:var(--gray-500); grid-column:1/-1;">Belum ada berita.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="komisi-section" id="komisi">
    <div class="container">
        <div class="fade-up">
            <span class="section-label">Bidang Kerja</span>
            <div class="section-title">Komisi-Komisi</div>
        </div>
        @forelse($commissions as $commission)
            <div class="komisi-block fade-up">
                <div class="komisi-header">
                    <h3>{{ $commission->name }}</h3>
                    @if($commission->description)<p style="color:rgba(255,255,255,0.6); font-size:0.85rem;">{{ $commission->description }}</p>@endif
                </div>
                <div class="komisi-members-grid">
                    @foreach($commission->members as $member)
                        <div class="komisi-member-card">
                            @if($member->photo)
                                <img class="komisi-member-photo" src="{{ $member->photo_url }}" alt="{{ $member->name }}">
                            @else
                                <div class="komisi-member-photo" style="background:rgba(255,255,255,0.1); display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-user" style="color:white; font-size:1.5rem"></i>
                                </div>
                            @endif
                            <div class="komisi-member-name">{{ $member->name }}</div>
                            <div class="komisi-member-pos">{{ $member->position }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="fade-up" style="text-align:center; color:rgba(255,255,255,0.5); padding:3rem;">Belum ada data komisi.</div>
        @endforelse
    </div>
</section>
@endsection

@section('extra-js')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    const swiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'slide',
        speed: 800,
    });

    (function createParticles() {
        const container = document.getElementById('particles');
        if(!container) return;
        for (let i = 0; i < 30; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + 'vw';
            p.style.width = p.style.height = Math.random() * 4 + 2 + 'px';
            p.style.animationDuration = Math.random() * 15 + 10 + 's';
            p.style.animationDelay = Math.random() * 10 + 's';
            p.style.opacity = Math.random() * 0.5 + 0.1;
            container.appendChild(p);
        }
    })();

    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => { entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } }); }, observerOptions);
    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
@endsection
