<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? ($settings->school_name ?? 'SMA Tunas Harapan') }}</title>
    
    <!-- Essential Meta Tags -->
    <meta name="description" content="{{ $metaDescription ?? $settings->meta_description ?? 'SMA Tunas Harapan - Sekolah Menengah Atas terbaik yang membentuk generasi cerdas, berkarakter, dan berwawasan global' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? $settings->meta_keywords ?? 'SMA Tunas Harapan, sekolah menengah atas, pendidikan berkualitas, sekolah terbaik, Jakarta' }}">
    <meta name="author" content="{{ $settings->school_name ?? 'SMA Tunas Harapan' }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? $settings->school_name ?? 'SMA Tunas Harapan' }}">
    <meta property="og:description" content="{{ $metaDescription ?? $settings->meta_description ?? 'SMA Tunas Harapan - Membentuk generasi cerdas dan berkarakter' }}">
    <meta property="og:image" content="{{ $ogImage ?? ($settings->hero_image ? Storage::url($settings->hero_image) : asset('storage/settings/hero_school.png')) }}">
    <meta property="og:site_name" content="{{ $settings->school_name ?? config('app.name') }}">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title ?? $settings->school_name ?? 'SMA Tunas Harapan' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? $settings->meta_description ?? 'SMA Tunas Harapan - Membentuk generasi cerdas dan berkarakter' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? ($settings->hero_image ? Storage::url($settings->hero_image) : asset('storage/settings/hero_school.png')) }}">

    <!-- Additional SEO -->
    <meta name="geo.region" content="ID-JK">
    <meta name="geo.placename" content="Jakarta">

    <!-- Favicon -->
    @if($settings && $settings->logo)
        <link rel="icon" type="image/png" href="{{ Storage::url($settings->logo) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans transition-colors duration-300 min-h-screen flex flex-col">
    
    {{-- Header --}}
    <x-navbar :settings="$settings" />

    {{-- Running Text (Moved from Hero) --}}
    <section class="bg-primary-dark border-b border-primary dark:border-gray-700 relative z-30">
        <div class="container mx-auto flex flex-col md:flex-row">
            <div class="bg-secondary text-primary font-bold px-6 py-2 flex items-center whitespace-nowrap z-10 shadow-lg text-sm">
                <i class="far fa-calendar-alt mr-2"></i> {{ now()->translatedFormat('d F Y') }}
            </div>
            <div class="flex-grow bg-white/5 dark:bg-black/20 py-2 px-4 flex items-center overflow-hidden relative">
                <div class="animate-marquee whitespace-nowrap text-white text-sm">
                    <span class="mx-4">• Selamat datang di website resmi {{ $settings->school_name ?? 'SMA Tunas Harapan' }}</span>
                    <span class="mx-4">• Pendaftaran Peserta Didik Baru dibuka setiap tahun ajaran</span>
                    <span class="mx-4">• Belajarlah seolah engkau akan hidup selamanya</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer :settings="$settings" />

    {{-- Back to Top --}}
    <button onclick="scrollToTop()" 
            class="fixed bottom-6 right-6 w-12 h-12 bg-primary text-white rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 flex items-center justify-center opacity-0 hover:opacity-100 focus:opacity-100"
            id="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Show/hide back to top button
        window.addEventListener('scroll', function() {
            const btn = document.getElementById('back-to-top');
            if (window.scrollY > 300) {
                btn.classList.remove('opacity-0');
                btn.classList.add('opacity-100');
            } else {
                btn.classList.remove('opacity-100');
                btn.classList.add('opacity-0');
            }
        });
    </script>

    {{-- Page-specific scripts (reCAPTCHA, etc) --}}
    @stack('scripts')
</body>
</html>
