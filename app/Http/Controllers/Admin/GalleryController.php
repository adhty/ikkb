<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images.*' => 'required|image|max:5120',
            'sort_order' => 'nullable|integer',
        ]);

        $baseData = $request->only(['title', 'sort_order']);
        $baseData['is_active'] = $request->has('is_active');

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $data = $baseData;
                $data['image'] = $file->store('galleries', 'public');
                Gallery::create($data);
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Foto slider berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.form', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'sort_order']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto slider berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto slider berhasil dihapus!');
    }
}
