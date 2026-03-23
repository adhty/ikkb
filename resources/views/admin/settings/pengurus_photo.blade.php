@extends('layouts.admin')

@section('title', 'Foto Pengurus Harian')
@section('page-title', 'Foto Pengurus Harian')
@section('breadcrumb', 'Admin / Konten / Foto Pengurus')

@section('content')
<div class="card">
    <div class="card-title"><i class="fas fa-camera"></i> Upload Foto Pengurus Harian</div>
    <p style="font-size:0.85rem; color:var(--gray-500); margin-bottom:1.5rem;">
        Foto ini akan ditampilkan di section Pengurus Harian di halaman utama (foto bersama / group photo).
    </p>
    <form method="POST" action="{{ route('admin.settings.pengurus-photo.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-bottom:1.5rem">
            <label>Upload Foto Bersama Pengurus</label>
            <input type="file" name="pengurus_harian_photo" accept="image/*">
            <div class="form-hint">Format: JPG, PNG, WebP. Maks 5MB. Ukuran ideal: 800×600px atau 4:3.</div>
        </div>
        @if(!empty($settings['pengurus_harian_photo']))
            <div class="photo-preview-wrap" style="margin-bottom:1.5rem">
                <p style="font-size:0.78rem; color:var(--gray-500); margin-bottom:0.5rem;">Foto saat ini:</p>
                <img src="{{ asset('storage/' . $settings['pengurus_harian_photo']) }}" alt="Foto Pengurus" style="max-width:300px;">
            </div>
        @endif
        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload Foto</button>
    </form>
</div>
@endsection
