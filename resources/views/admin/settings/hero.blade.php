@extends('layouts.admin')

@section('title', 'Edit Hero Section')
@section('page-title', 'Edit Hero Section')
@section('breadcrumb', 'Admin / Konten / Hero Section')

@section('content')
<div class="card">
    <div class="card-title"><i class="fas fa-image"></i> Edit Hero Section</div>
    <form method="POST" action="{{ route('admin.settings.hero.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row cols-2">
            <div class="form-group">
                <label>Teks Atas (Kecil/Italic) <span style="color:red">*</span></label>
                <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? 'Parlemen' }}" required
                       placeholder="cth: Parlemen">
                <div class="form-hint">Teks dekoratif kecil di atas judul utama</div>
            </div>
            <div class="form-group">
                <label>Judul Utama <span style="color:red">*</span></label>
                <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? 'CAKRA ABHIPRAYA' }}" required
                       placeholder="cth: CAKRA ABHIPRAYA">
            </div>
        </div>
        <div class="form-group">
            <label>Tagline / Deskripsi Singkat</label>
            <input type="text" name="hero_tagline" value="{{ $settings['hero_tagline'] ?? '' }}"
                   placeholder="cth: Bersama Satu Misi, Membangun Kampus...">
        </div>
        <div class="form-group">
            <label>Gambar Background Hero</label>
            <input type="file" name="hero_image" accept="image/*">
            <div class="form-hint">Format: JPG, PNG, WebP. Maks 5MB. Ukuran ideal: 1920×1080px.</div>
            @if(!empty($settings['hero_image']))
                <div class="photo-preview-wrap">
                    <img src="{{ asset('storage/' . $settings['hero_image']) }}" alt="Hero">
                    <div class="form-hint">Gambar saat ini. Upload baru untuk mengganti.</div>
                </div>
            @endif
        </div>
        <div style="display:flex; gap:0.75rem;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
            <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i> Preview</a>
        </div>
    </form>
</div>
@endsection
