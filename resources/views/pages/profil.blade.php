<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display text-center mb-8">
                Profil Sekolah
            </h1>
            
            @if($page)
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-8 prose dark:prose-invert max-w-none">
                    {!! $page->content !!}
                </div>
            @else
                 <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-8">
                    <div class="text-center py-10 text-gray-500">
                        <p>Konten belum tersedia.</p>
                    </div>
                    <p class="mt-4">
                        SMA Tunas Harapan didirikan dengan tujuan untuk memberikan pendidikan berkualitas tinggi kepada generasi muda Indonesia. 
                        Sekolah ini berkomitmen untuk membentuk karakter siswa yang tidak hanya cerdas secara akademik, 
                        tetapi juga memiliki integritas moral yang tinggi dan siap menghadapi tantangan global.
                    </p>
                    
                    <h3>Fasilitas</h3>
                    <ul>
                        <li>Ruang kelas ber-AC dengan multimedia</li>
                        <li>Laboratorium IPA (Fisika, Kimia, Biologi)</li>
                        <li>Laboratorium Komputer</li>
                        <li>Perpustakaan digital</li>
                        <li>Lapangan olahraga</li>
                        <li>Aula serbaguna</li>
                        <li>Masjid sekolah</li>
                        <li>Kantin sehat</li>
                    </ul>
                    
                    <h3>Alamat</h3>
                    <p>{{ $settings->address ?? 'Alamat belum diisi' }}</p>
                    
                    <div class="mt-8">
                        <a href="{{ route('pages.kontak') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-700 transition-colors shadow-lg font-bold">
                            <i class="fas fa-paper-plane mr-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</x-layouts.app>
