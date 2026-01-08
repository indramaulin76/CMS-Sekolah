<x-layouts.app :settings="$settings ?? null">
    <x-page-header title="Sambutan Kepala Sekolah" icon="fas fa-user-tie" />

    <div class="container mx-auto px-4 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
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
                    <p class="text-secondary">Kepala Sekolah</p>
                    @if($headmaster->period_start)
                    <p class="text-blue-200 text-sm mt-1">Periode: {{ $headmaster->period_start->format('Y') }} - {{ $headmaster->period_end ? $headmaster->period_end->format('Y') : 'Sekarang' }}</p>
                    @endif
                </div>
                
                {{-- Message --}}
                <div class="p-8">
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        {!! $headmaster->message !!}
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-12 bg-white dark:bg-surface-dark rounded-xl shadow-lg">
                <i class="fas fa-user-tie text-5xl text-gray-300 dark:text-gray-800 mb-4"></i>
                <p class="text-gray-700 dark:text-gray-200">Data Kepala Sekolah belum tersedia.</p>
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
