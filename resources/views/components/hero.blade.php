@props(['settings'])

@php
    $settings = $settings ?? (object) [];

    if (method_exists($settings, 'heroImagePaths')) {
        $heroImages = $settings->heroImagePaths();
    } else {
        $configuredHeroImages = $settings->hero_images ?? null;

        if (is_string($configuredHeroImages)) {
            $configuredHeroImages = json_decode($configuredHeroImages, true);
        }

        $heroImages = is_array($configuredHeroImages)
            ? array_values(array_filter(
                $configuredHeroImages,
                static fn ($image): bool => is_string($image) && $image !== ''
            ))
            : (filled($settings->hero_image ?? null) ? [$settings->hero_image] : []);
    }
@endphp

{{-- Hero Section --}}
<section class="relative bg-gray-900" aria-label="Hero sekolah">
    <div
        class="relative h-[350px] md:h-[450px] lg:h-[500px] w-full overflow-hidden"
        x-data="{
            current: 0,
            total: {{ count($heroImages) }},
            timer: null,
            start() {
                this.stop();
                if (this.total > 1) {
                    this.timer = setInterval(() => this.next(), 6000);
                }
            },
            stop() {
                if (this.timer !== null) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
            },
            next() {
                if (this.total > 1) {
                    this.current = (this.current + 1) % this.total;
                }
            },
        }"
        x-init="start()"
        x-on:visibilitychange.window="document.hidden ? stop() : start()"
        @if(count($heroImages) > 1)
            aria-roledescription="carousel"
        @endif
    >
        @if(count($heroImages) > 0)
            @foreach($heroImages as $index => $heroImage)
                <div
                    class="hero-slide absolute inset-0"
                    x-show="current === {{ $index }}"
                    @if($index > 0) x-cloak @endif
                    x-transition:enter="transition-opacity duration-1000 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-1000 ease-in"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    :class="{ 'is-active': current === {{ $index }} }"
                    :aria-hidden="current !== {{ $index }}"
                >
                    <img
                        src="{{ Storage::url($heroImage) }}"
                        alt="Foto hero {{ $settings->school_name ?? 'SMA Tunas Harapan' }}"
                        class="hero-slide-image absolute inset-0 h-full w-full object-cover"
                        loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                        decoding="async"
                        @if($index === 0) fetchpriority="high" @endif
                    >
                </div>
            @endforeach
        @else
            <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary-dark to-primary opacity-90"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>

        <div class="absolute bottom-0 left-0 right-0 p-6 pb-20 md:p-12 md:pb-24 lg:p-16 lg:pb-32 pointer-events-none">
            <div class="container mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-4 font-display leading-tight drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    {!! nl2br(e($settings->hero_title ?? 'Membangun Generasi Cerdas & Berkarakter')) !!}
                </h2>
                <p class="text-white text-lg md:text-xl max-w-2xl drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)] mb-8 font-medium">
                    {{ $settings->hero_subtitle ?? 'SMA Tunas Harapan berkomitmen mencetak pemimpin masa depan yang berakhlak mulia dan berwawasan global.' }}
                </p>
            </div>
        </div>

    </div>
</section>
