<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index()
    {
        $commissions = Commission::withCount('members')->orderBy('sort_order')->get();
        return view('admin.commissions.index', compact('commissions'));
    }

    public function create()
    {
        return view('admin.commissions.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);

        Commission::create($request->only(['name', 'description', 'sort_order']));
        return redirect()->route('admin.commissions.index')->with('success', 'Komisi berhasil ditambahkan!');
    }

    public function edit(Commission $commission)
    {
        return view('admin.commissions.form', compact('commission'));
    }

    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);

        $commission->update($request->only(['name', 'description', 'sort_order']));
        return redirect()->route('admin.commissions.index')->with('success', 'Komisi berhasil diperbarui!');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();
        return back()->with('success', 'Komisi berhasil dihapus!');
    }
}
