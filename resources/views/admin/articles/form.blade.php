@extends('layouts.admin')

@section('title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')
@section('page-title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')
@section('breadcrumb', 'Admin / Konten / Artikel / ' . (isset($article) ? 'Edit' : 'Tambah'))

@section('content')
<div class="card">
    <div class="card-title">
        <i class="fas {{ isset($article) ? 'fa-pen' : 'fa-plus' }}"></i>
        {{ isset($article) ? 'Edit Artikel' : 'Tambah Artikel Baru' }}
    </div>

    <form method="POST"
          action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if(isset($article)) @method('PUT') @endif

        <div class="form-row cols-2">
            <div class="form-group">
                <label>Kategori Artikel <span style="color:red">*</span></label>
                <select name="category" required>
                    <option value="berita" {{ (isset($article) && $article->category === 'berita') ? 'selected' : '' }}>Berita</option>
                    <option value="angket" {{ (isset($article) && $article->category === 'angket') ? 'selected' : '' }}>Angket / Link</option>
                </select>
            </div>
            <div class="form-group">
                <label>Judul Artikel <span style="color:red">*</span></label>
                <input type="text" name="title" value="{{ $article->title ?? '' }}" required placeholder="Masukkan judul...">
            </div>
        </div>

        <div class="form-group" style="margin-bottom:1.2rem">
            <label>Konten / Deskripsi (Hanya untuk Berita)</label>
            <textarea name="content" rows="6" placeholder="Isi berita...">{{ $article->content ?? '' }}</textarea>
        </div>

        <div class="form-group" style="margin-bottom:1.2rem">
            <label>Link / URL (Wajib untuk Angket)</label>
            <input type="url" name="link" value="{{ $article->link ?? '' }}" placeholder="https://docs.google.com/forms/...">
            <div class="form-hint">Kosongkan jika kategori adalah Berita</div>
        </div>

        <div class="form-row cols-2">
            <div class="form-group">
                <label>Gambar / Thumbnail</label>
                <input type="file" name="image" accept="image/*">
                <div class="form-hint">JPG, PNG, WebP. Maks 5MB.</div>
                @if(isset($article) && $article->image)
                    <div class="photo-preview-wrap">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Thumbnail">
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ $article->sort_order ?? 0 }}" min="0">
            </div>
        </div>

        <div class="form-group" style="margin-bottom:1.5rem">
            <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer;">
                <input type="checkbox" name="is_active" value="1" {{ (!isset($article) || $article->is_active) ? 'checked' : '' }} style="width:auto">
                Tampilkan di Website
            </label>
        </div>

        <div style="display:flex; gap:0.75rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($article) ? 'Simpan' : 'Tambah Artikel' }}
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
