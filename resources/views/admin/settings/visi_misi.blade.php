@extends('layouts.admin')

@section('title', 'Edit Visi & Misi')
@section('page-title', 'Edit Visi & Misi')
@section('breadcrumb', 'Admin / Konten / Visi & Misi')

@section('content')
<div class="card">
    <div class="card-title"><i class="fas fa-scroll"></i> Edit Visi &amp; Misi</div>
    <form method="POST" action="{{ route('admin.settings.visi-misi.update') }}">
        @csrf
        <div class="form-group" style="margin-bottom:1.2rem">
            <label>Teks Visi <span style="color:red">*</span></label>
            <textarea name="visi_content" rows="5" required placeholder="Masukkan teks visi organisasi...">{{ $settings['visi_content'] ?? '' }}</textarea>
        </div>
        <div class="form-group" style="margin-bottom:1.5rem">
            <label>Teks Misi <span style="color:red">*</span></label>
            <textarea name="misi_content" rows="10" required placeholder="Masukkan item misi, satu per baris...">{{ $settings['misi_content'] ?? '' }}</textarea>
            <div class="form-hint">💡 Tulis setiap poin misi di baris baru. Setiap baris akan menjadi satu item daftar.</div>
        </div>
        <div style="display:flex; gap:0.75rem;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
            <a href="{{ route('home') }}#visi-misi" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i> Preview</a>
        </div>
    </form>
</div>
@endsection
