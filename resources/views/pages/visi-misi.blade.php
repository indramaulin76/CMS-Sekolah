<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display text-center mb-8">
                Visi dan Misi
            </h1>
            
            @if(isset($page) && $page)
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-8 prose dark:prose-invert max-w-none">
                    {!! $page->content !!}
                </div>
            @else
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-8 text-center py-10 text-gray-500">
                    <p>Konten Visi dan Misi belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
