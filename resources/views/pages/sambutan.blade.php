<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white font-display text-center mb-8">
                Sambutan Kepala Sekolah
            </h1>
            
            @if($headmaster)
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-lg overflow-hidden">
                {{-- Header with Photo --}}
                <div class="bg-primary text-white p-8 text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full border-4 border-secondary overflow-hidden shadow-lg">
                        @if($headmaster->photo)
                            <img src="{{ Storage::url($headmaster->photo) }}" 
                                 alt="{{ $headmaster->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-white/10 flex items-center justify-center">
                                <i class="fas fa-user text-4xl text-white/50"></i>
                            </div>
                        @endif
                    </div>
                    <h2 class="text-2xl font-bold font-display">{{ $headmaster->name }}</h2>
                    <p class="text-secondary">{{ $headmaster->position }}</p>
                    @if($headmaster->start_year)
                    <p class="text-blue-200 text-sm mt-1">Periode: {{ $headmaster->tenure_period }}</p>
                    @endif
                </div>
                
                {{-- Quote --}}
                @if($headmaster->quote)
                <div class="bg-secondary/10 dark:bg-secondary/20 p-6 text-center">
                    <i class="fas fa-quote-left text-secondary text-2xl mb-2"></i>
                    <p class="text-lg italic text-gray-700 dark:text-gray-300">
                        "{{ $headmaster->quote }}"
                    </p>
                </div>
                @endif
                
                {{-- Message --}}
                <div class="p-8">
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        {!! $headmaster->message !!}
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-12 bg-surface-light dark:bg-surface-dark rounded-xl">
                <i class="fas fa-user-tie text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400">Data Kepala Sekolah belum tersedia.</p>
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
