@props(['post'])

<article class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 group flex flex-col md:flex-row card-hover">
    {{-- Thumbnail --}}
    <div class="md:w-1/3 relative overflow-hidden h-48 md:h-auto">
        @if($post->thumbnail)
            <img src="{{ Storage::url($post->thumbnail) }}" 
                 alt="{{ $post->title }}" 
                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($post->title) }}&background=random&color=fff&size=500'; this.parentElement.classList.add('bg-gray-200');"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                <i class="fas fa-newspaper text-white text-4xl opacity-50"></i>
            </div>
        @endif
        
        {{-- Category Badge --}}
        @if($post->category)
        <div class="absolute top-2 left-2 badge-{{ $post->category->color ?? 'gray' }} text-xs font-bold px-2 py-1 rounded">
            {{ $post->category->name }}
        </div>
        @endif
    </div>
    
    {{-- Content --}}
    <div class="p-6 md:w-2/3 flex flex-col justify-between">
        <div>
            {{-- Meta --}}
            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2 space-x-3">
                <span><i class="far fa-calendar mr-1"></i> {{ $post->published_at?->translatedFormat('d M Y') ?? '-' }}</span>
                <span><i class="far fa-user mr-1"></i> {{ $post->user?->name ?? 'Admin' }}</span>
                @if($post->views_count > 0)
                <span><i class="far fa-eye mr-1"></i> {{ number_format($post->views_count) }}</span>
                @endif
            </div>
            
            {{-- Title --}}
            <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2 group-hover:text-primary dark:group-hover:text-secondary transition-colors line-clamp-2">
                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
            </h4>
            
            {{-- Excerpt --}}
            <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2 mb-4">
                {{ $post->excerpt }}
            </p>
        </div>
        
        {{-- Read More --}}
        <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center text-sm font-semibold text-primary dark:text-secondary hover:underline">
            Baca Selengkapnya <i class="fas fa-long-arrow-alt-right ml-2"></i>
        </a>
    </div>
</article>
