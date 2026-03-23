<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use App\Models\Commission;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $pengurusHarian = OrganizationMember::where('type', 'harian')->orderBy('sort_order')->get();
        $memberKomisi   = OrganizationMember::where('type', 'komisi')
            ->with('commission')
            ->orderBy('sort_order')
            ->get();
        return view('admin.members.index', compact('pengurusHarian', 'memberKomisi'));
    }

    public function create()
    {
        $commissions = Commission::orderBy('sort_order')->get();
        return view('admin.members.form', compact('commissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'type'          => 'required|in:harian,komisi',
            'commission_id' => 'nullable|exists:commissions,id',
            'photo'         => 'nullable|image|max:5120',
            'sort_order'    => 'nullable|integer',
        ]);

        $data = $request->only(['name', 'position', 'type', 'commission_id', 'sort_order']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('members', 'public');
        }

        OrganizationMember::create($data);
        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(OrganizationMember $member)
    {
        $commissions = Commission::orderBy('sort_order')->get();
        return view('admin.members.form', compact('member', 'commissions'));
    }

    public function update(Request $request, OrganizationMember $member)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'type'          => 'required|in:harian,komisi',
            'commission_id' => 'nullable|exists:commissions,id',
            'photo'         => 'nullable|image|max:5120',
            'sort_order'    => 'nullable|integer',
        ]);

        $data = $request->only(['name', 'position', 'type', 'commission_id', 'sort_order']);

        if ($request->hasFile('photo')) {
            // delete old photo
            if ($member->photo && \Storage::disk('public')->exists($member->photo)) {
                \Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $request->file('photo')->store('members', 'public');
        }

        $member->update($data);
        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroy(OrganizationMember $member)
    {
        if ($member->photo && \Storage::disk('public')->exists($member->photo)) {
            \Storage::disk('public')->delete($member->photo);
        }
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus!');
    }
}
