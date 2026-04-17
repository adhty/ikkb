<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function hero()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings.hero', compact('settings'));
    }

    public function heroUpdate(Request $request)
    {
        $request->validate([
            'hero_title'    => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_tagline'  => 'nullable|string|max:500',
            'hero_image'    => 'nullable|image|max:5120',
        ]);

        SiteSetting::set('hero_title', $request->hero_title);
        SiteSetting::set('hero_subtitle', $request->hero_subtitle);
        SiteSetting::set('hero_tagline', $request->hero_tagline ?? '');

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('hero', 'public');
            SiteSetting::set('hero_image', $path);
        }

        return back()->with('success', 'Hero section berhasil diperbarui!');
    }

    public function visiMisi()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings.visi_misi', compact('settings'));
    }

    public function visiMisiUpdate(Request $request)
    {
        $request->validate([
            'visi_content' => 'required|string',
            'misi_content' => 'required|string',
        ]);

        SiteSetting::set('visi_content', $request->visi_content);
        SiteSetting::set('misi_content', $request->misi_content);

        return back()->with('success', 'Visi & Misi berhasil diperbarui!');
    }

    public function pengurusPhoto()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings.pengurus_photo', compact('settings'));
    }

    public function pengurusPhotoUpdate(Request $request)
    {
        $request->validate([
            'pengurus_harian_photo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('pengurus_harian_photo')) {
            $path = $request->file('pengurus_harian_photo')->store('pengurus', 'public');
            SiteSetting::set('pengurus_harian_photo', $path);
        }

        return back()->with('success', 'Foto pengurus harian berhasil diperbarui!');
    }

    public function sambutan()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings.sambutan', compact('settings'));
    }

    public function sambutanUpdate(Request $request)
    {
        $request->validate([
            'sambutan_title'   => 'required|string|max:255',
            'sambutan_name'    => 'required|string|max:255',
            'sambutan_content' => 'required|string',
            'sambutan_image'   => 'nullable|image|max:5120',
        ]);

        SiteSetting::set('sambutan_title', $request->sambutan_title);
        SiteSetting::set('sambutan_name', $request->sambutan_name);
        SiteSetting::set('sambutan_content', $request->sambutan_content);

        if ($request->hasFile('sambutan_image')) {
            $path = $request->file('sambutan_image')->store('sambutan', 'public');
            SiteSetting::set('sambutan_image', $path);
        }

        return back()->with('success', 'Sambutan Ketua berhasil diperbarui!');
    }

    public function general()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings.general', compact('settings'));
    }

    public function generalUpdate(Request $request)
    {
        $request->validate([
            'org_name'    => 'required|string|max:255',
            'org_periode' => 'required|string|max:20',
            'org_tagline' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:500',
            'org_logo'    => 'nullable|image|max:5120',
        ]);

        SiteSetting::set('org_name', $request->org_name);
        SiteSetting::set('org_periode', $request->org_periode);
        SiteSetting::set('org_tagline', $request->org_tagline ?? '');
        SiteSetting::set('footer_text', $request->footer_text ?? '');

        if ($request->hasFile('org_logo')) {
            $path = $request->file('org_logo')->store('settings', 'public');
            SiteSetting::set('org_logo', $path);
        }

        return back()->with('success', 'Pengaturan umum berhasil diperbarui!');
    }
}
