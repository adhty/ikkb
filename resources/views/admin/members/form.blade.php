@extends('layouts.admin')

@section('title', isset($member) ? 'Edit Anggota' : 'Tambah Anggota')
@section('page-title', isset($member) ? 'Edit Anggota' : 'Tambah Anggota')
@section('breadcrumb', 'Admin / Organisasi / ' . (isset($member) ? 'Edit' : 'Tambah'))

@section('content')
<div class="card">
    <div class="card-title">
        <i class="fas {{ isset($member) ? 'fa-pen' : 'fa-user-plus' }}"></i>
        {{ isset($member) ? 'Edit Anggota: ' . $member->name : 'Tambah Anggota Baru' }}
    </div>
    <form method="POST"
          action="{{ isset($member) ? route('admin.members.update', $member) : route('admin.members.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if(isset($member)) @method('PUT') @endif

        <div class="form-row cols-2">
            <div class="form-group">
                <label>Nama Lengkap <span style="color:red">*</span></label>
                <input type="text" name="name" value="{{ $member->name ?? '' }}" required placeholder="cth: Budi Santoso">
            </div>
            <div class="form-group">
                <label>Jabatan <span style="color:red">*</span></label>
                <input type="text" name="position" value="{{ $member->position ?? '' }}" required
                       placeholder="cth: Ketua / Bendahara / Anggota">
            </div>
        </div>

        <div class="form-row cols-2">
            <div class="form-group">
                <label>Tipe <span style="color:red">*</span></label>
                <select name="type" id="type-select" onchange="toggleKomisi()" required>
                    <option value="harian" {{ (isset($member) && $member->type === 'harian') ? 'selected' : '' }}>Pengurus Harian</option>
                    <option value="komisi" {{ (isset($member) && $member->type === 'komisi') ? 'selected' : '' }}>Anggota Komisi</option>
                </select>
            </div>
            <div class="form-group" id="komisi-select" style="{{ (isset($member) && $member->type === 'komisi') ? '' : 'display:none' }}">
                <label>Pilih Komisi</label>
                <select name="commission_id">
                    <option value="">-- Pilih Komisi --</option>
                    @foreach($commissions as $commission)
                        <option value="{{ $commission->id }}"
                            {{ (isset($member) && $member->commission_id == $commission->id) ? 'selected' : '' }}>
                            {{ $commission->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row cols-2">
            <div class="form-group">
                <label>Foto Profil</label>
                <input type="file" name="photo" accept="image/*">
                <div class="form-hint">JPG, PNG, WebP. Maks 5MB. Ukuran ideal: 400×400px (persegi).</div>
                @if(isset($member) && $member->photo)
                    <div class="photo-preview-wrap">
                        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
                             onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                        <div class="form-hint">Foto saat ini. Upload baru untuk mengganti.</div>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ $member->sort_order ?? 0 }}" min="0" placeholder="0">
                <div class="form-hint">Angka lebih kecil = tampil lebih dulu.</div>
            </div>
        </div>

        <div style="display:flex; gap:0.75rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($member) ? 'Simpan Perubahan' : 'Tambah Anggota' }}
            </button>
            <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<script>
function toggleKomisi() {
    const type = document.getElementById('type-select').value;
    document.getElementById('komisi-select').style.display = (type === 'komisi') ? '' : 'none';
}
</script>
@endsection
