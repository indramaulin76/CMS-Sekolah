<x-layouts.app :settings="$settings ?? null">
    <x-page-header title="Galeri Foto" icon="fas fa-images" />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        @if($galleries->isEmpty())
            <div class="text-center py-16 text-gray-700 bg-white dark:bg-surface-dark rounded-xl shadow-lg max-w-2xl mx-auto">
                <i class="fas fa-images text-5xl mb-4 text-gray-300"></i>
                <p class="text-lg">Belum ada album foto.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleries as $gallery)
                <a href="{{ route('galleries.show', $gallery->slug) }}" class="group block bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="relative h-64 overflow-hidden">
                        @if($gallery->thumbnail)
                            <img src="{{ Storage::url($gallery->thumbnail) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-images text-gray-200 text-5xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-80"></div>
                        <div class="absolute bottom-0 left-0 p-6">
                            <h3 class="text-xl font-bold text-white mb-2">{{ $gallery->title }}</h3>
                            <p class="text-white/80 text-sm line-clamp-2">{{ $gallery->description }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            @if($galleries->hasPages())
            <div class="mt-8">
                {{ $galleries->links() }}
            </div>
            @endif
        @endif
    </div>
</x-layouts.app>
