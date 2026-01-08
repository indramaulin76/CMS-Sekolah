<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                {{-- Page Header --}}
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display">
                        <i class="fas fa-search text-secondary mr-3"></i>Hasil Pencarian
                    </h1>
                    <p class="text-gray-800 dark:text-gray-200 mt-2">
                        Menampilkan hasil untuk: <strong>"{{ $query }}"</strong>
                    </p>
                </div>
                
                {{-- Results --}}
                <div class="space-y-6">
                    @forelse($posts as $post)
                        <x-article-card :post="$post" />
                    @empty
                        <div class="text-center py-12 bg-surface-light dark:bg-surface-dark rounded-xl">
                            <i class="fas fa-search text-5xl text-gray-300 dark:text-gray-800 mb-4"></i>
                            <p class="text-gray-700 dark:text-gray-200">Tidak ditemukan artikel untuk "{{ $query }}"</p>
                            <a href="{{ route('posts.index') }}" class="inline-block mt-4 text-primary hover:underline">
                                Lihat semua artikel
                            </a>
                        </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                @if($posts->hasPages())
                <div class="mt-8">
                    {{ $posts->appends(['q' => $query])->links() }}
                </div>
                @endif
            </div>
            
            {{-- Sidebar --}}
            <x-sidebar :categories="$sidebarCategories ?? collect()" />
        </div>
    </div>
</x-layouts.app>
