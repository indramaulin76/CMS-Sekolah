<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                {{-- Page Header --}}
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display">
                        <i class="far fa-newspaper text-secondary mr-3"></i>Berita & Artikel
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Informasi terbaru seputar kegiatan sekolah</p>
                </div>
                
                {{-- Posts List --}}
                <div class="space-y-6">
                    @forelse($posts as $post)
                        <x-article-card :post="$post" />
                    @empty
                        <div class="text-center py-12 bg-surface-light dark:bg-surface-dark rounded-xl">
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
