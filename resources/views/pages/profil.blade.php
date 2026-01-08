<x-layouts.app :settings="$settings ?? null">
    <x-page-header title="Profil Sekolah" icon="fas fa-school" />

    {{-- Main Content --}}
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-xl p-6 md:p-10 border-t-4 border-secondary">
                @if($page && $page->content)
                    <article class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-display prose-headings:text-primary prose-a:text-secondary hover:prose-a:text-secondary-dark prose-img:rounded-lg prose-img:shadow-md">
                        {!! $page->content !!}
                    </article>
                @else
                    <div class="text-center py-16 text-gray-700">
                         <i class="fas fa-file-alt text-5xl mb-4 text-gray-300"></i>
                         <p class="text-lg">Konten profil belum tersedia.</p>
                         <p class="text-sm mt-2">Silakan isi di <strong>Admin Panel > Halaman Statis > Profil</strong></p>
                    </div>
                @endif
            </div>

            {{-- Call to Action --}}
            <div class="mt-8 text-center">
                <a href="{{ route('pages.kontak') }}" class="inline-flex items-center px-8 py-3 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors shadow-lg font-bold text-lg">
                    <i class="fas fa-paper-plane mr-3"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
