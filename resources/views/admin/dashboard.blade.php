@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Admin / Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <h3>{{ $totalMembers }}</h3>
            <p>Total Anggota</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-layer-group"></i></div>
        <div class="stat-info">
            <h3>{{ $totalCommissions }}</h3>
            <p>Komisi</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
            <h3>Aktif</h3>
            <p>Status Website</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-title"><i class="fas fa-bolt"></i> Akses Cepat</div>
    <div class="quick-grid">
        <a href="{{ route('admin.settings.hero') }}" class="quick-card">
            <i class="fas fa-image"></i>
            <div>
                <h4>Edit Hero</h4>
                <p>Judul & gambar utama</p>
            </div>
        </a>
        <a href="{{ route('admin.settings.visi-misi') }}" class="quick-card">
            <i class="fas fa-scroll"></i>
            <div>
                <h4>Visi &amp; Misi</h4>
                <p>Teks visi dan misi</p>
            </div>
        </a>
        <a href="{{ route('admin.settings.pengurus-photo') }}" class="quick-card">
            <i class="fas fa-camera"></i>
            <div>
                <h4>Foto Pengurus</h4>
                <p>Foto bersama pengurus harian</p>
            </div>
        </a>
        <a href="{{ route('admin.members.create') }}" class="quick-card">
            <i class="fas fa-user-plus"></i>
            <div>
                <h4>Tambah Anggota</h4>
                <p>Tambah pengurus atau anggota komisi</p>
            </div>
        </a>
        <a href="{{ route('admin.commissions.create') }}" class="quick-card">
            <i class="fas fa-plus-circle"></i>
            <div>
                <h4>Tambah Komisi</h4>
                <p>Buat komisi baru</p>
            </div>
        </a>
        <a href="{{ route('admin.settings.general') }}" class="quick-card">
            <i class="fas fa-sliders"></i>
            <div>
                <h4>Pengaturan Umum</h4>
                <p>Nama organisasi, periode, dll</p>
            </div>
        </a>
    </div>
</div>
@endsection
