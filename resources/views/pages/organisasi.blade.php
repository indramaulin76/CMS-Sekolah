<x-layouts.app :settings="$settings ?? null">
    <x-page-header 
        title="Struktur Organisasi" 
        subtitle="SMA Tunas Harapan dikelola oleh tenaga pendidik dan kependidikan yang profesional dan berdedikasi."
        icon="fas fa-sitemap"
    />

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto pb-12">
            <!-- Org Chart Container -->
            <div class="flex flex-col items-center">
                
                <!-- Level 1: Kepala Sekolah -->
                @if($headmaster)
                <div class="flex flex-col items-center mb-12 relative z-10">
                    <div class="bg-primary text-white p-6 rounded-lg shadow-lg text-center w-64 border-b-4 border-blue-800">
                        @if($headmaster->photo)
                            <img src="{{ Storage::url($headmaster->photo) }}" alt="{{ $headmaster->name }}" class="w-24 h-24 rounded-full object-cover mx-auto mb-3 border-4 border-white/20">
                        @else
                            <div class="w-24 h-24 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-user text-4xl text-white/50"></i>
                            </div>
                        @endif
                        <div class="text-sm uppercase tracking-wide opacity-80 mb-1">Kepala Sekolah</div>
                        <div class="font-bold text-lg">{{ $headmaster->name }}</div>

                    </div>
                </div>

                @endif
                
                <!-- Level 2 Connector -->
                @if($wakas->count() > 0)
                <div class="w-full flex justify-center mb-12">
                    <div class="relative w-full flex flex-col items-center">
                        <!-- Wakas Grid -->
                        <div class="flex flex-wrap justify-center gap-8 z-10 w-full px-4 relative">
                            @foreach($wakas as $waka)
                            <div class="flex flex-col items-center relative">
                                <!-- Box -->
                                <div class="bg-secondary/20 border border-secondary text-gray-800 dark:text-gray-100 p-4 rounded-lg shadow-sm text-center w-56 hover:shadow-md transition bg-white dark:bg-gray-800">
                                    @if($waka->photo)
                                        <img src="{{ Storage::url($waka->photo) }}" alt="{{ $waka->name }}" class="w-20 h-20 rounded-full object-cover mx-auto mb-3 border-2 border-secondary">
                                    @else
                                        <div class="w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                            <i class="fas fa-user text-3xl text-gray-200"></i>
                                        </div>
                                    @endif
                                    <div class="text-xs uppercase font-bold text-secondary mb-1">{{ $waka->position }}</div>
                                    <div class="font-bold text-md leading-tight">{{ $waka->name }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif


                <!-- Level 3: Guru & Staff Group -->
                @if($others->count() > 0)
                <div class="w-full mt-8">
                    <div class="text-center mb-8 relative">
                        <span class="bg-gray-50 dark:bg-gray-800 px-4 text-gray-200 text-sm relative z-10 uppercase tracking-widest font-bold">Dewan Guru & Staff</span>
                        <div class="absolute top-1/2 w-full border-t border-gray-200 -z-0"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($others as $staff)
                        <div class="bg-white dark:bg-surface-dark border border-gray-100 dark:border-gray-700 p-4 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                            @if($staff->photo)
                                <img src="{{ Storage::url($staff->photo) }}" alt="{{ $staff->name }}" class="w-16 h-16 rounded-full object-cover mx-auto mb-3 border border-gray-200">
                            @else
                                <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center mx-auto mb-3 border border-gray-100 dark:border-gray-700">
                                    <i class="fas fa-user text-2xl text-gray-300"></i>
                                </div>
                            @endif
                            <div class="font-bold text-gray-800 dark:text-gray-100 group-hover:text-primary transition">{{ $staff->name }}</div>
                            <div class="text-sm text-gray-700 dark:text-gray-200 mt-1">{{ $staff->position }}</div>

                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
