@extends('layouts.admin')

@section('title', isset($gallery) ? 'Edit Foto Slider' : 'Tambah Foto Slider')
@section('page-title', isset($gallery) ? 'Edit Foto Slider' : 'Tambah Foto Slider')
@section('breadcrumb', 'Admin / Galeri Slider / ' . (isset($gallery) ? 'Edit' : 'Tambah'))

@section('content')
<div class="card" style="max-width: 800px;">
    <div class="card-title"><i class="fas fa-{{ isset($gallery) ? 'edit' : 'plus-circle' }}"></i> {{ isset($gallery) ? 'Edit Data Foto' : 'Tambah Foto Baru' }}</div>

    <form method="POST" action="{{ isset($gallery) ? route('admin.galleries.update', $gallery->id) : route('admin.galleries.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($gallery)) @method('PUT') @endif

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label>Foto Slider <span style="color:red">*</span></label>
            @if(isset($gallery))
                <div class="photo-preview-wrap" style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="Preview" style="max-width: 300px; border-radius: 12px;">
                    <p class="form-hint">Foto saat ini</p>
                </div>
                <input type="file" name="image" accept="image/*">
            @else
                <input type="file" name="images[]" multiple required accept="image/*">
            @endif
            <p class="form-hint">Kamu bisa pilih lebih dari 1 foto sekaligus. Gunakan foto landscape berkualitas tinggi.</p>
        </div>

        <div class="form-group" style="margin-bottom: 1.2rem;">
            <label>Judul Teks (Opsional)</label>
            <input type="text" name="title" value="{{ old('title', $gallery->title ?? '') }}" placeholder="Akan muncul sebagai teks kecil di atas foto">
        </div>

        <div class="form-row cols-2">
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}">
                <p class="form-hint">Angka lebih kecil tampil lebih dulu.</p>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.8rem;">
                    <input type="checkbox" name="is_active" id="is_active" style="width: auto;" {{ old('is_active', $gallery->is_active ?? true) ? 'checked' : '' }}>
                    <label for="is_active" style="margin-bottom: 0; cursor: pointer;">Tampilkan di Slider Utama</label>
                </div>
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
