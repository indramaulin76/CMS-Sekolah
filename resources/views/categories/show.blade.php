<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                {{-- Page Header --}}
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display">
                        <i class="fas fa-tag text-secondary mr-3"></i>{{ $category->name }}
                    </h1>
                    @if($category->description)
                    <p class="text-gray-800 dark:text-gray-200 mt-2">{{ $category->description }}</p>
                    @endif
                </div>
                
                {{-- Posts List --}}
                <div class="space-y-6">
                    @forelse($posts as $post)
                        <x-article-card :post="$post" />
                    @empty
                        <div class="text-center py-12 bg-surface-light dark:bg-surface-dark rounded-xl">
                            <i class="far fa-folder-open text-5xl text-gray-300 dark:text-gray-800 mb-4"></i>
                            <p class="text-gray-700 dark:text-gray-200">Belum ada artikel dalam kategori ini.</p>
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
