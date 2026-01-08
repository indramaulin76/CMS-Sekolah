@props(['headmaster' => null, 'categories' => collect()])

<aside class="space-y-8">
    {{-- Search Widget --}}
    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Pencarian</h4>
        <form action="{{ route('posts.search') }}" method="GET" class="relative">
            <input type="text" 
                   name="q"
                   value="{{ request('q') }}"
                   class="w-full pl-4 pr-10 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" 
                   placeholder="Cari artikel...">
            <button type="submit" class="absolute right-3 top-3 text-gray-200 hover:text-primary transition-colors">
                <i class="fas fa-search text-lg"></i>
            </button>
        </form>
    </div>
    
    {{-- Headmaster Greeting Widget --}}
    @if($headmaster)
    <div class="bg-primary rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
        <h4 class="text-lg font-bold mb-4 font-display border-b border-white/20 pb-2">Sambutan Kepala Sekolah</h4>
        <div class="flex items-center space-x-4 mb-4">
            @if($headmaster->photo)
                <img src="{{ Storage::url($headmaster->photo) }}" 
                     alt="{{ $headmaster->name }}" 
                     class="w-16 h-16 rounded-full border-2 border-secondary object-cover">
            @else
                <div class="w-16 h-16 rounded-full border-2 border-secondary bg-white/10 flex items-center justify-center">
                    <i class="fas fa-user text-2xl text-white/50"></i>
                </div>
            @endif
            <div>
                <p class="font-bold text-sm">{{ $headmaster->name }}</p>
                <p class="text-xs text-blue-200">{{ $headmaster->position }}</p>
            </div>
        </div>
        @if($headmaster->quote)
        <p class="text-sm text-blue-100 italic mb-4">
            "{{ $headmaster->quote }}"
        </p>
        @endif
        <a href="{{ route('pages.sambutan') }}" class="text-xs font-bold text-secondary hover:text-white uppercase tracking-wider flex items-center">
            Baca Sambutan <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
        </a>
    </div>
    @endif
    
    {{-- Categories Widget --}}
    @if($categories->isNotEmpty())
    <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Kategori</h4>
        <ul class="space-y-2">
            @foreach($categories as $category)
            <li>
                <a href="{{ route('categories.show', $category->slug) }}" 
                   class="flex justify-between items-center text-gray-800 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition-colors py-2 border-b border-dashed border-gray-200 dark:border-gray-700">
                    <span>{{ $category->name }}</span>
                    <span class="bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded-full">{{ $category->posts_count ?? 0 }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    
    {{-- Video Widget --}} 
    @if(isset($settings->sidebar_video_url) && $settings->sidebar_video_url)
        @php
            $videoUrl = $settings->sidebar_video_url;
            $embedUrl = null;
            
            // Extract YouTube video ID and create embed URL (supports watch, embed, live, and youtu.be)
            if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|live\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
                $videoId = $matches[1];
                $embedUrl = "https://www.youtube-nocookie.com/embed/" . $videoId;
            }
        @endphp
        
        @if($embedUrl)
        <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm p-6 mb-8 border border-gray-100 dark:border-gray-700">
            <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Video Terbaru</h4>
            
            <div class="aspect-video rounded-lg overflow-hidden shadow-md">
                <iframe src="{{ $embedUrl }}" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen 
                        class="w-full h-full">
                </iframe>
            </div>
        </div>
        @endif
    @endif
    
    {{-- Popular Links Widget --}}
    @php
        $links = \App\Models\Link::where('is_active', true)->orderBy('order', 'asc')->get();
    @endphp

    @if($links->count() > 0)
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm p-6 mb-8 border border-gray-100 dark:border-gray-700">
        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">Tautan Populer</h4>
        
        <div class="flex flex-wrap gap-2">
            @foreach($links as $link)
            <a href="{{ $link->url }}" target="{{ $link->target }}" class="px-4 py-2 bg-gray-50 dark:bg-gray-700 hover:bg-secondary hover:text-primary text-gray-800 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors duration-300">
                {{ $link->title }}
            </a>
            @endforeach
        </div>
    </div>
    @endif
</aside>
