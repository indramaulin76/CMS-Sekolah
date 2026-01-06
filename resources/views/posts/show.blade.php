<x-layouts.app :settings="$settings ?? null">
    <article class="container mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                {{-- Breadcrumb --}}
                <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('posts.index') }}" class="hover:text-primary">Berita</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-700 dark:text-gray-300">{{ Str::limit($post->title, 30) }}</span>
                </nav>
                
                {{-- Article Header --}}
                <header class="mb-8">
                    @if($post->category)
                    <span class="inline-block badge-{{ $post->category->color ?? 'gray' }} text-xs font-bold px-3 py-1 rounded mb-4">
                        {{ $post->category->name }}
                    </span>
                    @endif
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white font-display leading-tight mb-4">
                        {{ $post->title }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center text-sm text-gray-500 dark:text-gray-400 space-x-4">
                        <span><i class="far fa-calendar mr-1"></i> {{ $post->published_at?->translatedFormat('d F Y') }}</span>
                        <span><i class="far fa-user mr-1"></i> {{ $post->user?->name ?? 'Admin' }}</span>
                        <span><i class="far fa-eye mr-1"></i> {{ number_format($post->views_count) }} views</span>
                    </div>
                </header>
                
                {{-- Featured Image --}}
                @if($post->thumbnail)
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ Storage::url($post->thumbnail) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-auto">
                </div>
                @endif
                
                <div class="prose prose-lg dark:prose-invert max-w-none mb-12">
                    {!! \App\Helpers\HtmlSanitizer::clean($post->content) !!}
                </div>
                
                {{-- Share Buttons --}}
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mb-8">
                    <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 mr-4">Bagikan:</span>
                    <div class="inline-flex space-x-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" 
                           target="_blank"
                           class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                {{-- Related Posts --}}
                @if($relatedPosts->isNotEmpty())
                <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Artikel Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($relatedPosts as $related)
                        <a href="{{ route('posts.show', $related->slug) }}" class="group">
                            <div class="bg-surface-light dark:bg-surface-dark rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                @if($related->thumbnail)
                                    <img src="{{ Storage::url($related->thumbnail) }}" 
                                         alt="{{ $related->title }}" 
                                         class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-32 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                                        <i class="fas fa-newspaper text-white text-2xl opacity-50"></i>
                                    </div>
                                @endif
                                <div class="p-3">
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-white line-clamp-2 group-hover:text-primary dark:group-hover:text-secondary transition-colors">
                                        {{ $related->title }}
                                    </h4>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            {{-- Sidebar --}}
            <x-sidebar :categories="$sidebarCategories ?? collect()" />
        </div>
    </article>
</x-layouts.app>
