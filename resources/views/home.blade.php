<x-layouts.app :settings="$settings">
    {{-- Hero Section --}}
    <x-hero :settings="$settings" />
    
    {{-- Info Bar --}}
    <x-info-bar :settings="$settings" />
    
    {{-- Main Content --}}
    <section class="container mx-auto px-4 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Articles Section --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Section Header --}}
                <div class="flex items-center justify-between border-b-2 border-gray-200 dark:border-gray-700 pb-3 mb-6">
                    <h3 class="text-2xl font-bold text-primary dark:text-white flex items-center">
                        <i class="far fa-newspaper mr-3 text-secondary"></i> Artikel Terkini
                    </h3>
                    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-primary dark:text-gray-400 hover:text-secondary dark:hover:text-white transition-colors">
                        Lihat Semua
                    </a>
                </div>
                
                {{-- Articles List --}}
                @forelse($latestPosts as $post)
                    <x-article-card :post="$post" />
                @empty
                    <div class="text-center py-12 bg-surface-light dark:bg-surface-dark rounded-xl">
                        <i class="far fa-newspaper text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                        <p class="text-gray-500 dark:text-gray-400">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
            
            {{-- Sidebar --}}
            <x-sidebar :headmaster="$headmaster" :categories="$categories" />
        </div>
    </section>
    
    {{-- Upcoming Events Section --}}
    @if($upcomingEvents->isNotEmpty())
    <section class="bg-gray-100 dark:bg-gray-800 py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800 dark:text-white font-display">
                    <i class="fas fa-calendar-alt text-secondary mr-3"></i>Agenda Mendatang
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Kegiatan dan acara yang akan datang</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($upcomingEvents as $event)
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden card-hover">
                    @if($event->thumbnail)
                        <img src="{{ Storage::url($event->thumbnail) }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                            <i class="fas fa-calendar-check text-white text-4xl opacity-50"></i>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-primary dark:text-secondary mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            {{ $event->event_date->translatedFormat('d F Y') }}
                            @if($event->event_time)
                                <span class="mx-2">•</span>
                                <i class="far fa-clock mr-1"></i>
                                {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                            @endif
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-2 line-clamp-2">
                            {{ $event->title }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-secondary"></i>
                            {{ $event->location }}
                        </p>
                        <a href="{{ route('events.show', $event->slug) }}" class="inline-block mt-4 text-sm font-semibold text-primary dark:text-secondary hover:underline">
                            Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('events.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-700 transition-colors shadow-lg">
                    Lihat Semua Agenda <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
    @endif
</x-layouts.app>
