<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SiteSetting;
use App\Models\Commission;
use App\Models\OrganizationMember;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@parlemen.id',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // Default site settings
        $settings = [
            'hero_title'          => 'Parlemen',
            'hero_subtitle'       => 'CAKRA ABHIPRAYA',
            'hero_tagline'        => 'Bersama Satu Misi, Membangun Kampus yang Lebih Baik',
            'hero_image'          => '',
            'visi_title'          => 'Visi & Misi',
            'visi_content'        => 'Mewujudkan SEMA FISHUM sebagai lembaga representatif yang inklusif, responsif dan kolaboratif dengan semangat BERSEMA (Bersama Serta Maju) dan menciptakan lingkungan kampus yang Adil, Nyaman dan Progresif bagi seluruh Mahasiswa Fakultas Ilmu Sosial dan Humaniora UIN Sunan Kalijaga.',
            'misi_content'        => "Membangun komunikasi yang inklusif dan efektif melalui platform digital, forum aspirasi, dan kunjungan langsung untuk mendengar, memahami, dan menindaklanjuti suara mahasiswa.\nMengawal Proses Banding UKT dengan menyediakan informasi yang jelas, panduan prosedural, serta pendampingan langsung bagi mahasiswa yang membutuhkan.\nMembangun kerangka kerja yang cepat dan terukur dalam merespon isu Mahasiswa melalui konsolidasi internal yang terorganisir, serta berkolaborasi dengan pihak-pihak terkait untuk solusi yang efektif.",
            'org_name'            => 'Parlemen CAKRA ABHIPRAYA',
            'org_periode'         => '2025',
            'org_tagline'         => 'BERSAMA SEMA MAJU, VIVA LEGISLATIF!',
            'navbar_logo'         => 'Parlemen',
            'footer_text'         => '© 2025 Parlemen CAKRA ABHIPRAYA. All rights reserved.',
            'pengurus_harian_photo' => '',
            'sambutan_title'      => 'KETUA SEMA FISHUM',
            'sambutan_name'       => 'Muhammad Fauzun',
            'sambutan_content'    => "Hadirnya website sebagai sarana informasi bentuk rasa syukur SEMA FISHUM UIN Sunan Kalijaga website ini hadir hadirkan sebagai bentuk komitmen dalam mewujudkan transparansi, partisipasi, dan keterbukaan informasi kepada seluruh mahasiswa FISHUM.\n\nMelalui platform ini kami berharap dapat memberikan akses informasi yang cepat, mudah, dan terpercaya mengenai kegiatan, kebijakan, serta program kerja SEMA FISHUM. Tidak hanya itu, website ini juga diharapkan menjadi jembatan komunikasi yang efektif antara SEMA dan seluruh mahasiswa FISHUM, agar aspirasi dan kebutuhan kalian dapat tersampaikan dengan baik.\n\nKami menyadari bahwa di era digital saat ini, keakuratan dan kecepatan informasi sangatlah penting. Oleh karena itu, kehadiran website ini menjadi bukti nyata dedikasi kami untuk terus berkembang, beradaptasi, dan melayani dengan lebih baik.\n\nAkhir kata, kami mengajak seluruh mahasiswa FISHUM untuk ikut serta memanfaatkan dan mengembangkan website ini sebagai rumah bersama, wadah bertukar informasi, gagasan, dan kreativitas.",
            'sambutan_image'      => '',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::create(['key' => $key, 'value' => $value]);
        }

        // Default commissions
        $kom1 = Commission::create(['name' => 'Komisi I : Akademik',      'sort_order' => 1]);
        $kom2 = Commission::create(['name' => 'Komisi II : Kesejahteraan', 'sort_order' => 2]);
        $kom3 = Commission::create(['name' => 'Komisi III : Advokasi',     'sort_order' => 3]);

        // Add Sample Berita
        Article::create([
            'title' => 'Sema FISHUM UIN Sunan Kalijaga Gelar Pembekalan',
            'content' => 'Bangun Kepengurusan Progresif, SEMA FISHUM UIN Sunan Kalijaga Gelar Pembekalan Ormawa Bersama Demisioner.',
            'category' => 'berita',
            'sort_order' => 1,
        ]);

        Article::create([
            'title' => 'SAH! Pengurus ORMAWA FISHUM 2025 Resmi Dilantik',
            'content' => 'Pelantikan pengurus baru berjalan khidmat di Gedung Teater FISHUM.',
            'category' => 'berita',
            'sort_order' => 2,
        ]);

        // Add Sample Angket
        Article::create([
            'title' => 'Angket Kritik & Saran ORMAWA FISHUM',
            'link' => 'https://google.com',
            'category' => 'angket',
            'sort_order' => 1,
        ]);

        Article::create([
            'title' => 'LAPOR PAK SENAT!',
            'link' => 'https://google.com',
            'category' => 'angket',
            'sort_order' => 2,
        ]);

        // Add Sample Members (Harian)
        OrganizationMember::create([
            'name' => 'Muhammad Fauzun',
            'position' => 'Ketua SEMA FISHUM',
            'type' => 'harian',
            'sort_order' => 1,
        ]);

        OrganizationMember::create([
            'name' => 'Siti Aminah',
            'position' => 'Sekretaris Jenderal',
            'type' => 'harian',
            'sort_order' => 2,
        ]);

        // Add Sample Members (Komisi)
        OrganizationMember::create([
            'name' => 'Ahmad Zaki',
            'position' => 'Ketua Komisi I',
            'type' => 'komisi',
            'commission_id' => $kom1->id,
            'sort_order' => 1,
        ]);

        OrganizationMember::create([
            'name' => 'Zahra Putri',
            'position' => 'Anggota Komisi II',
            'type' => 'komisi',
            'commission_id' => $kom2->id,
            'sort_order' => 1,
        ]);
    }
}
