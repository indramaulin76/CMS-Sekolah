<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $profileContent = <<<'HTML'
<h2>Tentang SMA Tunas Harapan</h2>
<p>SMA Tunas Harapan didirikan pada tahun 1985 dengan visi untuk menjadi lembaga pendidikan yang unggul dalam menghasilkan generasi muda yang cerdas, berkarakter, dan siap menghadapi tantangan global. Selama lebih dari tiga dekade, kami telah berkomitmen untuk memberikan pendidikan berkualitas tinggi kepada ribuan siswa.</p>

<p>Sebagai salah satu sekolah menengah atas terkemuka di wilayah ini, SMA Tunas Harapan terus berinovasi dalam metode pengajaran dan pengembangan kurikulum untuk memastikan siswa kami mendapatkan pendidikan terbaik yang relevan dengan kebutuhan zaman.</p>

<h3>Visi</h3>
<p>Menjadi sekolah unggulan yang menghasilkan lulusan berakhlak mulia, berprestasi akademik, dan berdaya saing global.</p>

<h3>Misi</h3>
<ul>
<li>Menyelenggarakan pendidikan yang berkualitas dan berorientasi pada pengembangan karakter</li>
<li>Mengembangkan potensi siswa secara optimal dalam bidang akademik, seni, dan olahraga</li>
<li>Menciptakan lingkungan belajar yang kondusif dan menyenangkan</li>
<li>Membangun kerjasama yang harmonis antara sekolah, orang tua, dan masyarakat</li>
</ul>

<h3>Fasilitas Unggulan</h3>
<p>SMA Tunas Harapan dilengkapi dengan berbagai fasilitas modern untuk mendukung proses belajar mengajar:</p>
<ul>
<li>Ruang kelas ber-AC dengan peralatan multimedia</li>
<li>Laboratorium IPA lengkap (Fisika, Kimia, Biologi)</li>
<li>Laboratorium Komputer dengan koneksi internet cepat</li>
<li>Perpustakaan digital dengan koleksi ribuan buku</li>
<li>Lapangan olahraga (basket, futsal, voli)</li>
<li>Aula serbaguna berkapasitas 500 orang</li>
<li>Masjid sekolah untuk kegiatan keagamaan</li>
<li>Kantin sehat dengan menu bergizi</li>
</ul>

<h3>Prestasi</h3>
<p>SMA Tunas Harapan telah meraih berbagai prestasi di tingkat kabupaten, provinsi, hingga nasional dalam bidang akademik, seni, dan olahraga. Lulusan kami diterima di berbagai perguruan tinggi negeri dan swasta terkemuka di Indonesia.</p>
HTML;

        Page::updateOrCreate(
            ['slug' => 'profil'],
            [
                'title' => 'Profil Sekolah',
                'content' => $profileContent,
                'status' => 'published',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'visi-misi'],
            [
                'title' => 'Visi dan Misi',
                'content' => '<h2>Visi</h2><p>Menjadi sekolah unggulan yang menghasilkan lulusan berakhlak mulia, berprestasi akademik, dan berdaya saing global.</p><h2>Misi</h2><ul><li>Menyelenggarakan pendidikan berkualitas</li><li>Mengembangkan potensi siswa secara optimal</li><li>Menciptakan lingkungan belajar kondusif</li></ul>',
                'status' => 'published',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'hubungi-kami'],
            [
                'title' => 'Hubungi Kami',
                'content' => '<p>Silakan hubungi kami untuk informasi lebih lanjut tentang SMA Tunas Harapan.</p>',
                'status' => 'published',
            ]
        );
    }
}
