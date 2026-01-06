<x-layouts.app :settings="$settings ?? null">
    <x-page-header title="Berita & Artikel" subtitle="Informasi terbaru seputar kegiatan sekolah" icon="far fa-newspaper" />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                {{-- Posts List --}}
                <div class="space-y-6">
                    @forelse($posts as $post)
                        <x-article-card :post="$post" />
                    @empty
                        <div class="text-center py-12 bg-white dark:bg-surface-dark rounded-xl shadow-lg">
                            <i class="far fa-newspaper text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                            <p class="text-gray-500 dark:text-gray-400">Belum ada artikel yang dipublikasikan.</p>
                        </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                @if($posts->hasPages())
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
                @endif
            </div>
            
            {{-- Sidebar --}}
            <x-sidebar :categories="$sidebarCategories ?? collect()" />
        </div>
    </div>
</x-layouts.app>
