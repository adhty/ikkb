@extends('layouts.admin')

@section('title', 'Pengaturan Umum')
@section('page-title', 'Pengaturan Umum')
@section('breadcrumb', 'Admin / Pengaturan Umum')

@section('content')
<div class="card">
    <div class="card-title"><i class="fas fa-sliders"></i> Pengaturan Umum</div>
    <form method="POST" action="{{ route('admin.settings.general.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-bottom:1.5rem">
            <label>Logo Organisasi</label>
            @if(!empty($settings['org_logo']))
                <div class="photo-preview-wrap" style="margin-bottom: 0.8rem;">
                    <img src="{{ asset('storage/' . $settings['org_logo']) }}" alt="Logo Current" style="max-height: 80px; width: auto; object-fit: contain;">
                    <p class="form-hint" style="margin-top: 0.2rem;">Logo saat ini</p>
                </div>
            @endif
            <input type="file" name="org_logo" accept="image/*">
            <p class="form-hint">Disarankan format PNG transparan, ukuran maksimal 5MB.</p>
        </div>

        <div class="form-row cols-2">
            <div class="form-group">
                <label>Nama Organisasi <span style="color:red">*</span></label>
                <input type="text" name="org_name" value="{{ $settings['org_name'] ?? 'Parlemen CAKRA ABHIPRAYA' }}" required>
            </div>
            <div class="form-group">
                <label>Periode / Tahun <span style="color:red">*</span></label>
                <input type="text" name="org_periode" value="{{ $settings['org_periode'] ?? '2025' }}" required placeholder="2025">
            </div>
        </div>
        <div class="form-group" style="margin-bottom:1.2rem">
            <label>Tagline / Motto Organisasi</label>
            <input type="text" name="org_tagline" value="{{ $settings['org_tagline'] ?? '' }}" placeholder="cth: BERSAMA SEMA MAJU, VIVA LEGISLATIF!">
        </div>
        <div class="form-group" style="margin-bottom:1.5rem">
            <label>Teks Footer</label>
            <input type="text" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}" placeholder="© 2025 Parlemen CAKRA ABHIPRAYA...">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    </form>
</div>
@endsection
