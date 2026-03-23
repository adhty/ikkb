@extends('layouts.admin')

@section('title', 'Kelola Komisi')
@section('page-title', 'Kelola Komisi')
@section('breadcrumb', 'Admin / Organisasi / Komisi')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
    <h2 style="font-size:0.95rem; color:var(--gray-500);">Daftar komisi dalam organisasi</h2>
    <a href="{{ route('admin.commissions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Komisi
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Komisi</th>
                    <th>Deskripsi</th>
                    <th>Jml Anggota</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commissions as $commission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $commission->name }}</strong></td>
                        <td>{{ $commission->description ?? '-' }}</td>
                        <td>
                            <span style="background:var(--blue-pale); color:var(--blue-mid); padding:0.2rem 0.6rem; border-radius:100px; font-size:0.78rem; font-weight:600;">
                                {{ $commission->members_count }}
                            </span>
                        </td>
                        <td>{{ $commission->sort_order }}</td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.commissions.edit', $commission) }}" class="btn btn-success" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.commissions.destroy', $commission) }}" onsubmit="return confirm('Hapus komisi ini? Anggotanya akan kehilangan relasi komisi.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:var(--gray-500); font-style:italic;">
                            Belum ada komisi. <a href="{{ route('admin.commissions.create') }}">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
