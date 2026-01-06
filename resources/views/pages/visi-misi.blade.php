<x-layouts.app :settings="$settings ?? null">
    <x-page-header title="Visi dan Misi" icon="fas fa-bullseye" />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            @if(isset($page) && $page)
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-6 md:p-10 border-t-4 border-secondary prose prose-lg dark:prose-invert max-w-none">
                    {!! $page->content !!}
                </div>
            @else
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-8 text-center py-10 text-gray-500">
                    <i class="fas fa-bullseye text-4xl mb-4 text-gray-300"></i>
                    <p>Konten Visi dan Misi belum tersedia.</p>
                    <p class="text-sm mt-2">Silakan isi di <strong>Admin Panel > Halaman Statis</strong></p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
