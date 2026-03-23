@extends('layouts.admin')

@section('title', 'Anggota & Pengurus')
@section('page-title', 'Anggota & Pengurus')
@section('breadcrumb', 'Admin / Organisasi / Anggota')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
    <div>
        <h2 style="font-size:0.95rem; color:var(--gray-500);">Kelola pengurus harian dan anggota komisi</h2>
    </div>
    <a href="{{ route('admin.members.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Anggota
    </a>
</div>

<!-- Pengurus Harian -->
<div class="card">
    <div class="card-title"><i class="fas fa-star"></i> Pengurus Harian</div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengurusHarian as $member)
                    <tr>
                        <td>
                            <img class="tbl-avatar"
                                 src="{{ $member->photo_url }}"
                                 alt="{{ $member->name }}"
                                 onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                        </td>
                        <td><strong>{{ $member->name }}</strong></td>
                        <td>{{ $member->position }}</td>
                        <td>{{ $member->sort_order }}</td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-success" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.members.destroy', $member) }}" onsubmit="return confirm('Hapus anggota ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center; color:var(--gray-500); font-style:italic;">Belum ada pengurus harian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Anggota Komisi -->
<div class="card">
    <div class="card-title"><i class="fas fa-layer-group"></i> Anggota Komisi</div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Komisi</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($memberKomisi as $member)
                    <tr>
                        <td>
                            <img class="tbl-avatar"
                                 src="{{ $member->photo_url }}"
                                 alt="{{ $member->name }}"
                                 onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                        </td>
                        <td><strong>{{ $member->name }}</strong></td>
                        <td>{{ $member->position }}</td>
                        <td>{{ $member->commission?->name ?? '-' }}</td>
                        <td>{{ $member->sort_order }}</td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-success" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.members.destroy', $member) }}" onsubmit="return confirm('Hapus anggota ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; color:var(--gray-500); font-style:italic;">Belum ada anggota komisi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
