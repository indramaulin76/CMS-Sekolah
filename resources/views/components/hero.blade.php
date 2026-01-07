@props(['settings'])

{{-- Hero Section --}}
<section class="relative bg-gray-900">
    <div class="relative h-[350px] md:h-[450px] lg:h-[500px] w-full overflow-hidden">
        @if($settings && $settings->hero_image)
            <img src="{{ Storage::url($settings->hero_image) }}" 
                 alt="SMA Tunas Harapan" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80">
        @else
            <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary-dark to-primary opacity-90"></div>
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-6 pb-20 md:p-12 md:pb-24 lg:p-16 lg:pb-32">
            <div class="container mx-auto">
                <span class="inline-block px-3 py-1 mb-4 text-xs font-bold tracking-wider text-primary uppercase bg-secondary rounded shadow">
                    Selamat Datang
                </span>
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-display leading-tight drop-shadow-md">
                    {!! nl2br(e($settings->hero_title ?? 'Membangun Generasi Cerdas & Berkarakter')) !!}
                </h2>
                <p class="text-gray-200 text-lg md:text-xl max-w-2xl drop-shadow mb-8">
                    {{ $settings->hero_subtitle ?? 'SMA Tunas Harapan berkomitmen mencetak pemimpin masa depan yang berakhlak mulia dan berwawasan global.' }}
                </p>
            </div>
        </div>
    </div>
</section>


