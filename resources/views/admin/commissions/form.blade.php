@extends('layouts.admin')

@section('title', isset($commission) ? 'Edit Komisi' : 'Tambah Komisi')
@section('page-title', isset($commission) ? 'Edit Komisi' : 'Tambah Komisi')
@section('breadcrumb', 'Admin / Organisasi / Komisi / ' . (isset($commission) ? 'Edit' : 'Tambah'))

@section('content')
<div class="card">
    <div class="card-title">
        <i class="fas {{ isset($commission) ? 'fa-pen' : 'fa-plus-circle' }}"></i>
        {{ isset($commission) ? 'Edit Komisi' : 'Tambah Komisi Baru' }}
    </div>

    <form method="POST"
          action="{{ isset($commission) ? route('admin.commissions.update', $commission) : route('admin.commissions.store') }}">
        @csrf
        @if(isset($commission)) @method('PUT') @endif

        <div class="form-group" style="margin-bottom:1.2rem">
            <label>Nama Komisi <span style="color:red">*</span></label>
            <input type="text" name="name" value="{{ $commission->name ?? '' }}" required
                   placeholder="cth: Komisi I : Akademik">
        </div>

        <div class="form-group" style="margin-bottom:1.2rem">
            <label>Deskripsi (opsional)</label>
            <input type="text" name="description" value="{{ $commission->description ?? '' }}"
                   placeholder="Deskripsi singkat komisi ini">
        </div>

        <div class="form-group" style="margin-bottom:1.5rem; max-width:200px">
            <label>Urutan Tampil</label>
            <input type="number" name="sort_order" value="{{ $commission->sort_order ?? 0 }}" min="0">
            <div class="form-hint">Angka lebih kecil = tampil lebih dulu.</div>
        </div>

        <div style="display:flex; gap:0.75rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($commission) ? 'Simpan' : 'Tambah Komisi' }}
            </button>
            <a href="{{ route('admin.commissions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
