@extends('layouts.app')

@section('title', $article->title . ' - ' . ($settings['org_name'] ?? 'IKKB'))

@section('extra-css')
    <style>
        .article-header {
            padding: 120px 0 60px;
            background: linear-gradient(135deg, var(--blue-deep) 0%, var(--blue-main) 100%);
            color: white;
            text-align: center;
        }
        .article-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            max-width: 900px;
            margin: 0 auto 1rem;
            line-height: 1.2;
        }
        .article-meta {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
        }
        .article-content-wrap {
            max-width: 850px;
            margin: -40px auto 100px;
            background: white;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }
        .article-img {
            width: 100%;
            border-radius: 16px;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .article-body {
            font-size: 1.1rem;
            line-height: 1.9;
            color: var(--gray-600);
            white-space: pre-line;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--blue-mid);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            transition: all 0.2s;
        }
        .btn-back:hover {
            color: var(--blue-deep);
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .article-content-wrap {
                margin-top: 20px;
                padding: 1.5rem;
                border-radius: 0;
            }
            .article-title { font-size: 1.8rem; }
        }
    </style>
@endsection

@section('content')
<header class="article-header">
    <div class="container">
        <h1 class="article-title">{{ $article->title }}</h1>
        <div class="article-meta">
            <span><i class="far fa-calendar-alt"></i> {{ $article->created_at->format('d M Y') }}</span>
            <span><i class="far fa-folder-open"></i> {{ ucfirst($article->category) }}</span>
        </div>
    </div>
</header>

<div class="container">
    <div class="article-content-wrap">
        <a href="{{ route('home') }}#berita" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Berita
        </a>

        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="article-img">
        @endif

        <div class="article-body">
            {!! $article->content !!}

            @if($article->link)
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px dashed var(--gray-200);">
                    <p style="font-size: 0.9rem; color: var(--gray-500); margin-bottom: 0.8rem;">Ingin tahu lebih banyak? Kunjungi tautan berikut:</p>
                    <a href="{{ $article->link }}" target="_blank" class="btn-back" style="margin-bottom: 0; color: var(--gold); border: 1px solid var(--gold); padding: 0.6rem 1.2rem; border-radius: 10px; display: inline-flex;">
                        Info Lebih Lanjut <i class="fas fa-external-link-alt" style="font-size: 0.8rem; margin-left: 0.5rem;"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    /* Halaman detail script if any */
@endsection
