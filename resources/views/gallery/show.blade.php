<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="mb-8 text-center max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display mb-4">
                {{ $gallery->title }}
            </h1>
            @if($gallery->description)
                <p class="text-gray-600 dark:text-gray-300">{{ $gallery->description }}</p>
            @endif
        </div>

        @if($gallery->images->isEmpty())
             <div class="text-center py-10 text-gray-500 bg-white dark:bg-surface-dark rounded-xl shadow-lg">
                <p>Album ini belum memiliki foto.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid">
                @foreach($gallery->images as $image)
                <div class="relative group cursor-pointer overflow-hidden rounded-lg shadow-md aspect-square">
                    <img src="{{ Storage::url($image->image) }}" alt="{{ $image->caption ?? $gallery->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        @if($image->caption)
                            <p class="text-white text-sm font-medium">{{ $image->caption }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
        
        <div class="mt-12 text-center">
            <a href="{{ route('galleries.index') }}" class="inline-flex items-center px-6 py-3 bg-secondary text-white font-bold rounded-lg hover:bg-secondary-dark transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Galeri
            </a>
        </div>
    </div>
</x-layouts.app>
