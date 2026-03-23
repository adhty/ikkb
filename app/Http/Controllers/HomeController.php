<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Commission;
use App\Models\OrganizationMember;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');
        $pengurusHarian = OrganizationMember::where('type', 'harian')
            ->orderBy('sort_order')
            ->get();
        $commissions = Commission::with(['members' => function($q) {
            $q->where('type', 'komisi')->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        $berita = \App\Models\Article::where('category', 'berita')->where('is_active', true)->orderBy('sort_order')->get();
        $angket = \App\Models\Article::where('category', 'angket')->where('is_active', true)->orderBy('sort_order')->get();

        return view('welcome', compact('settings', 'pengurusHarian', 'commissions', 'berita', 'angket'));
    }
}
