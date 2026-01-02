<x-layouts.app :settings="$settings ?? null">
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-primary mb-4 font-display">Struktur Organisasi</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                SMA Tunas Harapan dikelola oleh tenaga pendidik dan kependidikan yang profesional dan berdedikasi.
            </p>
        </div>

        <div class="max-w-6xl mx-auto overflow-x-auto pb-12">
            <!-- Org Chart Container -->
            <div class="flex flex-col items-center min-w-[800px]">
                
                <!-- Level 1: Kepala Sekolah -->
                @if($headmaster)
                <div class="flex flex-col items-center mb-12 relative z-10">
                    <div class="bg-blue-600 text-white p-6 rounded-lg shadow-lg text-center w-64 border-b-4 border-blue-800">
                        <div class="text-sm uppercase tracking-wide opacity-80 mb-1">Kepala Sekolah</div>
                        <div class="font-bold text-lg">{{ $headmaster->name }}</div>
                        @if($headmaster->nip)<div class="text-xs mt-1 opacity-75">{{ $headmaster->nip }}</div>@endif
                    </div>
                </div>
                <!-- Connector Line Vertical -->
                <div class="absolute w-0.5 bg-gray-300 h-12 -mt-12 mb-0" style="margin-top: -3rem; z-index: 0;"></div>
                @endif
                
                <!-- Connector Line Horizontal for Level 2 -->
                {{-- Logic: Only if there are multiple Wakas, draw horizontal line --}}
                @if($wakas->count() > 0)
                <div class="relative w-full flex justify-center mb-12">
                    <!-- The horizontal line spanning the wakas -->
                    <div class="absolute top-0 w-3/4 h-8 border-t-2 border-r-2 border-l-2 border-gray-300 rounded-t-xl -mt-6"></div>

                    <!-- Level 2 Grid -->
                    <div class="flex flex-wrap justify-center gap-8 z-10 w-full px-4 mt-6">
                        @foreach($wakas as $waka)
                        <div class="flex flex-col items-center relative">
                            <!-- Vertical connector from horizontal line -->
                            <div class="w-0.5 h-6 bg-gray-300 absolute -top-6"></div>
                            
                            <!-- Box -->
                            <div class="bg-orange-100 border border-orange-300 text-gray-800 p-4 rounded-lg shadow-sm text-center w-56 hover:shadow-md transition">
                                <div class="text-xs uppercase font-bold text-orange-600 mb-1">{{ $waka->position }}</div>
                                <div class="font-bold text-md leading-tight">{{ $waka->name }}</div>
                                @if($waka->nip)<div class="text-xs text-gray-500 mt-1">{{ $waka->nip }}</div>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Level 3: Guru & Staff Group -->
                @if($others->count() > 0)
                <div class="w-full mt-8">
                    <div class="text-center mb-8 relative">
                        <span class="bg-white px-4 text-gray-400 text-sm relative z-10 uppercase tracking-widest font-bold">Dewan Guru & Staff</span>
                        <div class="absolute top-1/2 w-full border-t border-gray-200 -z-0"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($others as $staff)
                        <div class="bg-white border border-gray-100 p-4 rounded-lg shadow-sm hover:shadow-md transition text-center group">
                            <div class="font-bold text-gray-800 group-hover:text-primary transition">{{ $staff->name }}</div>
                            <div class="text-sm text-gray-500 mt-1">{{ $staff->position }}</div>
                            @if($staff->nip)<div class="text-xs text-gray-400 mt-1">{{ $staff->nip }}</div>@endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
