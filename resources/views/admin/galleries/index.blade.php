@extends('layouts.admin')

@section('title', 'Galeri Slider')
@section('page-title', 'Galeri Slider')
@section('breadcrumb', 'Admin / Galeri Slider')

@section('content')
<div class="card">
    <div class="card-title" style="justify-content: space-between;">
        <span><i class="fas fa-images"></i> Galeri Slider Utama</span>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm" style="font-size: 0.75rem; padding: 0.4rem 0.8rem;">
            <i class="fas fa-plus"></i> Tambah Foto
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">Urutan</th>
                    <th style="width: 150px;">Pratinjau</th>
                    <th>Judul (Opsional)</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 120px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $gallery)
                    <tr>
                        <td>{{ $gallery->sort_order }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="Slider" style="width: 100px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--gray-200);">
                        </td>
                        <td><strong>{{ $gallery->title ?? '-' }}</strong></td>
                        <td>
                            @if($gallery->is_active)
                                <span class="badge-type badge-harian" style="background:#f0fdf4; color:#166534;">Aktif</span>
                            @else
                                <span class="badge-type badge-komisi" style="background:#fef2f2; color:#991b1b;">Nonaktif</span>
                            @endif
                        </td>
                        <td class="td-actions" style="justify-content: flex-end;">
                            <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-secondary" style="padding:0.4rem; font-size:0.8rem;"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari slider?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:0.4rem; font-size:0.8rem;"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--gray-500); padding: 3rem;">Belum ada foto slider. Silakan tambahkan foto pertama kamu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
