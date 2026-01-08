<x-layouts.app :settings="$settings ?? null">
    <x-page-header :title="$gallery->title" :subtitle="$gallery->description" icon="fas fa-images" />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        @if(empty($gallery->images))
             <div class="text-center py-16 text-gray-700 bg-white dark:bg-surface-dark rounded-xl shadow-lg max-w-2xl mx-auto">
                <i class="fas fa-images text-5xl mb-4 text-gray-300"></i>
                <p class="text-lg">Album ini belum memiliki foto.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid">
                @foreach($gallery->images as $index => $image)
                <div class="relative group cursor-pointer overflow-hidden rounded-lg shadow-md aspect-square" onclick="openLightbox({{ $index }})">
                    <img src="{{ Storage::url($image['image']) }}" alt="{{ $image['caption'] ?? $gallery->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl"></i>
                    </div>
                    @if(!empty($image['caption']))
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                        <p class="text-white text-sm font-medium">{{ $image['caption'] }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @endif
        
        <div class="mt-12 text-center">
            <a href="{{ route('galleries.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Galeri
            </a>
        </div>
    </div>

    {{-- Lightbox Modal --}}
    <div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center" onclick="closeLightbox(event)">
        <div class="max-w-5xl max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
            <p id="lightbox-caption" class="text-white text-lg mt-4 text-center"></p>
        </div>
    </div>

    @push('scripts')
    <script>
        const images = @json(
            collect($gallery->images ?? [])->map(fn($img) => [
                'image' => $img['image'],
                'caption' => $img['caption'] ?? '',
                'full_url' => Storage::url($img['image'])
            ])
        );
        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            showImage();
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(event) {
            if (event) event.stopPropagation();
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function showImage() {
            const img = images[currentIndex];
            document.getElementById('lightbox-img').src = img.full_url;
            document.getElementById('lightbox-caption').textContent = img.caption || '';
        }

        function prevImage(event) {
            event.stopPropagation();
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage();
        }

        function nextImage(event) {
            event.stopPropagation();
            currentIndex = (currentIndex + 1) % images.length;
            showImage();
        }

        document.addEventListener('keydown', function(e) {
            if (document.getElementById('lightbox').classList.contains('hidden')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') prevImage(e);
            if (e.key === 'ArrowRight') nextImage(e);
        });
    </script>
    @endpush
</x-layouts.app>
