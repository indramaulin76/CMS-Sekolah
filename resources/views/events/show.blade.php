<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('events.index') }}" class="hover:text-primary">Agenda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-300">{{ Str::limit($event->title, 30) }}</span>
        </nav>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                {{-- Event Header --}}
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden">
                    @if($event->thumbnail)
                        <img src="{{ Storage::url($event->thumbnail) }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-64 md:h-96 object-cover">
                    @endif
                    
                    <div class="p-8">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display mb-6">
                            {{ $event->title }}
                        </h1>
                        
                        {{-- Event Info --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-center p-4 bg-primary/10 dark:bg-primary/20 rounded-lg">
                                <i class="far fa-calendar-alt text-2xl text-primary mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Tanggal</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $event->event_date->translatedFormat('l, d F Y') }}</span>
                                </div>
                            </div>
                            
                            @if($event->event_time)
                            <div class="flex items-center p-4 bg-secondary/10 dark:bg-secondary/20 rounded-lg">
                                <i class="far fa-clock text-2xl text-secondary mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Waktu</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</span>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-center p-4 bg-green-500/10 dark:bg-green-500/20 rounded-lg">
                                <i class="fas fa-map-marker-alt text-2xl text-green-500 mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Lokasi</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $event->location }}</span>
                                </div>
                            </div>
                            
                            @if($event->organizer)
                            <div class="flex items-center p-4 bg-purple-500/10 dark:bg-purple-500/20 rounded-lg">
                                <i class="fas fa-users text-2xl text-purple-500 mr-4"></i>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Penyelenggara</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $event->organizer }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        {{-- Description --}}
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            {!! \App\Helpers\HtmlSanitizer::clean($event->description) !!}
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Other Upcoming Events --}}
                @if($upcomingEvents->isNotEmpty())
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 border-l-4 border-secondary pl-3">
                        Agenda Lainnya
                    </h3>
                    <div class="space-y-4">
                        @foreach($upcomingEvents as $upcoming)
                        <a href="{{ route('events.show', $upcoming->slug) }}" class="block group">
                            <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-primary">{{ $upcoming->event_date->format('d') }}</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 group-hover:text-primary dark:group-hover:text-secondary line-clamp-2">
                                        {{ $upcoming->title }}
                                    </h4>
                                    <span class="text-xs text-gray-500">{{ $upcoming->event_date->translatedFormat('M Y') }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {{-- Back Button --}}
                <a href="{{ route('events.index') }}" class="block w-full text-center py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Agenda
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
