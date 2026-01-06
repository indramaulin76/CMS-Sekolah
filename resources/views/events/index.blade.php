<x-layouts.app :settings="$settings ?? null">
    <x-page-header title="Agenda Kegiatan" subtitle="Jadwal kegiatan dan acara sekolah" icon="fas fa-calendar-alt" />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        {{-- Upcoming Events --}}
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 flex items-center">
            <span class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm mr-3">
                <i class="fas fa-arrow-up"></i>
            </span>
            Agenda Mendatang
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($upcomingEvents as $event)
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden card-hover border border-gray-100 dark:border-gray-700">
                @if($event->thumbnail)
                    <img src="{{ Storage::url($event->thumbnail) }}" 
                         alt="{{ $event->title }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-primary to-blue-800 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-white text-5xl opacity-50"></i>
                    </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center text-sm text-primary dark:text-secondary mb-3">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ $event->start_date->translatedFormat('d F Y') }}
                        @if($event->end_date)
                            <span class="mx-2">-</span>
                            {{ $event->end_date->translatedFormat('d F Y') }}
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3 line-clamp-2">
                        {{ $event->title }}
                    </h3>
                    @if($event->location)
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-secondary"></i>
                        {{ $event->location }}
                    </p>
                    @endif
                    <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center text-sm font-semibold text-primary dark:text-secondary hover:underline">
                        Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 bg-white dark:bg-surface-dark rounded-xl shadow-lg">
                <i class="fas fa-calendar-times text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400">Tidak ada agenda mendatang saat ini.</p>
            </div>
            @endforelse
        </div>
        
        {{-- Pagination --}}
        @if($upcomingEvents->hasPages())
        <div class="mb-12">
            {{ $upcomingEvents->links() }}
        </div>
        @endif
        
        {{-- Past Events --}}
        @if($pastEvents->isNotEmpty())
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 flex items-center">
            <span class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white text-sm mr-3">
                <i class="fas fa-history"></i>
            </span>
            Agenda Sebelumnya
        </h2>
        
        <div class="space-y-4">
            @foreach($pastEvents as $event)
            <div class="bg-white dark:bg-surface-dark rounded-lg shadow-sm p-4 flex items-center justify-between border border-gray-100 dark:border-gray-700 opacity-75 hover:opacity-100 transition-opacity">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center flex-shrink-0">
                        <div class="text-center">
                            <span class="block text-xl font-bold text-gray-600 dark:text-gray-400">{{ $event->start_date->format('d') }}</span>
                            <span class="block text-xs text-gray-500">{{ $event->start_date->translatedFormat('M Y') }}</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">{{ $event->title }}</h4>
                        <p class="text-sm text-gray-500">{{ $event->location }}</p>
                    </div>
                </div>
                <a href="{{ route('events.show', $event->slug) }}" class="text-primary dark:text-secondary text-sm hover:underline">
                    Detail
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-layouts.app>
