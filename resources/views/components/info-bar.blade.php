@props(['settings'])

{{-- Floating Info Bar --}}
<section class="relative z-20 -mt-8 md:-mt-12 container mx-auto px-4 lg:px-8 mb-16">
    <div class="grid grid-cols-1 md:grid-cols-3 bg-primary rounded-xl shadow-2xl overflow-hidden text-white">
        {{-- Location Card --}}
        <div class="md:col-span-2 p-6 md:p-10 border-b md:border-b-0 md:border-r border-white/10 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/5 rounded-full blur-3xl group-hover:bg-white/10 transition-all duration-700"></div>
            <div class="flex items-start space-x-4 md:space-x-6 relative z-10">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-secondary rounded-2xl flex items-center justify-center shadow-lg transform rotate-3 group-hover:rotate-0 transition-transform duration-300">
                        <i class="fas fa-map-marker-alt text-primary text-2xl md:text-3xl"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl md:text-2xl font-bold font-display mb-1">{{ $settings->school_name ?? 'SMA TUNAS HARAPAN' }}</h3>
                    <p class="text-secondary italic text-xs md:text-sm mb-4 opacity-90">{{ $settings->tagline ?? 'Sekolahnya Para Pemimpin' }}</p>
                    <p class="text-gray-300 leading-relaxed text-sm">
                        {{ $settings->address ?? 'Alamat belum diisi' }}
                    </p>
                    <a href="{{ $settings->google_maps_link ?? '#' }}" target="_blank" class="inline-flex items-center mt-4 text-sm font-semibold text-secondary hover:text-white transition-colors">
                        Lihat di Peta <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Social Media Card --}}
        <div class="p-6 md:p-10 flex flex-col justify-center relative overflow-hidden group">
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 bg-secondary/10 rounded-full blur-2xl group-hover:bg-secondary/20 transition-all duration-700"></div>
            <div class="flex items-center space-x-4 mb-6 relative z-10">
                <i class="far fa-comments text-secondary text-3xl md:text-4xl"></i>
                <h3 class="text-xl md:text-2xl font-bold font-display">Media Sosial</h3>
            </div>
            <div class="flex space-x-4 relative z-10">
                @if($settings && $settings->facebook_url)
                <a href="{{ $settings->facebook_url }}" target="_blank" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fab fa-facebook-f text-lg"></i>
                </a>
                @endif
                @if($settings && $settings->instagram_url)
                <a href="{{ $settings->instagram_url }}" target="_blank" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fab fa-instagram text-lg"></i>
                </a>
                @endif
                @if($settings && $settings->tiktok_url)
                <a href="{{ $settings->tiktok_url }}" target="_blank" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fa-brands fa-tiktok text-lg"></i>
                </a>
                @endif
                @if($settings && $settings->youtube_url)
                <a href="{{ $settings->youtube_url }}" target="_blank" class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fab fa-youtube text-lg"></i>
                </a>
                @endif
            </div>
            <p class="mt-6 text-xs text-gray-400">Ikuti kami untuk update kegiatan terbaru sekolah.</p>
        </div>
    </div>
</section>
