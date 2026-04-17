@extends('layouts.admin')

@section('title', 'Berita & Angket')
@section('page-title', 'Berita & Angket')
@section('breadcrumb', 'Admin / Konten / Artikel')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
    <h2 style="font-size:0.95rem; color:var(--gray-500);">Kelola konten berita dan angket/link eksternal</h2>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Artikel
    </a>
</div>

<!-- Berita -->
<div class="card">
    <div class="card-title"><i class="fas fa-newspaper"></i> Daftar Berita</div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($berita as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="tbl-avatar" style="border-radius:8px; width:60px; height:40px;">
                            @else
                                <div style="width:60px; height:40px; background:var(--gray-100); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-image" style="color:var(--gray-200)"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $item->title }}</strong></td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            <span class="badge-type {{ $item->is_active ? 'badge-harian' : 'badge-danger' }}" style="background:{{ $item->is_active ? '#f0fdf4' : '#fef2f2' }}; color:{{ $item->is_active ? '#16a34a' : '#dc2626' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.articles.edit', $item) }}" class="btn btn-success" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $item) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center; color:var(--gray-500); font-style:italic;">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
</div>

<!-- Acara/Kegiatan -->
<div class="card">
    <div class="card-title"><i class="fas fa-calendar-check"></i> Daftar Acara / Kegiatan</div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Acara</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($acara as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="tbl-avatar" style="border-radius:8px; width:60px; height:40px;">
                            @else
                                <div style="width:60px; height:40px; background:var(--gray-100); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-calendar-alt" style="color:var(--gray-200)"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $item->title }}</strong></td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            <span class="badge-type {{ $item->is_active ? 'badge-harian' : 'badge-danger' }}" style="background:{{ $item->is_active ? '#f0fdf4' : '#fef2f2' }}; color:{{ $item->is_active ? '#16a34a' : '#dc2626' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.articles.edit', $item) }}" class="btn btn-success" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $item) }}" onsubmit="return confirm('Hapus acara ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center; color:var(--gray-500); font-style:italic;">Belum ada acara kegiatan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Angket -->
<div class="card">
    <div class="card-title"><i class="fas fa-poll-h"></i> Daftar Angket / Link</div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Angket</th>
                    <th>Link/URL</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($angket as $item)
                    <tr>
                        <td>
                             @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="tbl-avatar" style="border-radius:8px; width:60px; height:60px; object-fit:contain;">
                            @else
                                <div style="width:60px; height:60px; background:var(--gray-100); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-poll" style="color:var(--gray-200); font-size:1.5rem;"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $item->title }}</strong></td>
                        <td><a href="{{ $item->link }}" target="_blank" style="color:var(--blue-mid); font-size:0.75rem;">{{ Str::limit($item->link, 40) }}</a></td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.articles.edit', $item) }}" class="btn btn-success" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $item) }}" onsubmit="return confirm('Hapus angket ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:0.3rem 0.7rem; font-size:0.78rem;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center; color:var(--gray-500); font-style:italic;">Belum ada link angket.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
