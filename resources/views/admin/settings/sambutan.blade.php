@extends('layouts.admin')

@section('title', 'Edit Sambutan Ketua')
@section('page-title', 'Edit Sambutan Ketua')
@section('breadcrumb', 'Admin / Konten / Sambutan')

@section('content')
<div class="card">
    <div class="card-title"><i class="fas fa-comment-dots"></i> Edit Sambutan Ketua</div>
    <form method="POST" action="{{ route('admin.settings.sambutan.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row cols-2">
            <div class="form-group">
                <label>Jabatan/Judul Sambutan <span style="color:red">*</span></label>
                <input type="text" name="sambutan_title" value="{{ $settings['sambutan_title'] ?? 'KETUA SEMA FISHUM' }}" required>
            </div>
            <div class="form-group">
                <label>Nama Ketua <span style="color:red">*</span></label>
                <input type="text" name="sambutan_name" value="{{ $settings['sambutan_name'] ?? '' }}" required>
            </div>
        </div>
        <div class="form-group">
            <label>Isi Sambutan <span style="color:red">*</span></label>
            <textarea name="sambutan_content" rows="10" required>{{ $settings['sambutan_content'] ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label>Foto Ketua</label>
            <input type="file" name="sambutan_image" accept="image/*">
            <div class="form-hint">Format: JPG, PNG, WebP. Maks 5MB. Ukuran ideal: 500x700px.</div>
            @if(!empty($settings['sambutan_image']))
                <div class="photo-preview-wrap">
                    <img src="{{ asset('storage/' . $settings['sambutan_image']) }}" alt="Foto Ketua" style="max-width:200px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
    </form>
</div>
@endsection
