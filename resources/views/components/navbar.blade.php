@props(['settings'])

<header class="bg-primary text-white shadow-lg sticky top-0 z-50">
    {{-- Top Bar --}}
    <div class="container mx-auto px-4 lg:px-8 py-3 flex flex-col md:flex-row justify-between items-center">
        {{-- Logo & Brand --}}
        <div class="flex items-center space-x-4 md:mb-0">
            <a href="{{ route('home') }}" class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center p-1 shadow-md">
                    @if($settings && $settings->logo)
                        <img src="{{ Storage::url($settings->logo) }}" alt="Logo" class="w-full h-full object-contain rounded-full">
                    @else
                        <i class="fas fa-graduation-cap text-primary text-2xl"></i>
                    @endif
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold uppercase tracking-wide font-display text-white">
                        {{ $settings->school_name ?? 'SMA Tunas Harapan' }}
                    </h1>
                    <p class="text-xs text-blue-200 font-light tracking-wider">
                        {{ $settings->tagline ?? 'Sekolahnya Para Pemimpin' }}
                    </p>
                </div>
            </a>
        </div>
        
        {{-- Contact Info --}}
        <div class="hidden md:flex flex-row items-center space-x-6 text-sm font-medium">
            @if($settings && $settings->phone)
            <a href="tel:{{ $settings->phone }}" class="flex items-center hover:text-secondary transition-colors group">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-2 group-hover:bg-secondary group-hover:text-primary transition-all">
                    <i class="fas fa-phone-alt text-xs"></i>
                </span>
                <span>{{ $settings->phone }}</span>
            </a>
            @endif
            
            @if($settings && $settings->email)
            <a href="mailto:{{ $settings->email }}" class="flex items-center hover:text-secondary transition-colors group">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-2 group-hover:bg-secondary group-hover:text-primary transition-all">
                    <i class="fas fa-envelope text-xs"></i>
                </span>
                <span>{{ $settings->email }}</span>
            </a>
            @endif
        </div>
    </div>

    {{-- Navigation --}}
    {{-- Navigation --}}
    <nav class="bg-primary-dark border-t border-white/10" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4 lg:px-8">
            {{-- Mobile Menu Button --}}
            <div class="md:hidden flex justify-between items-center py-3">
                <span class="text-white font-medium">Menu</span>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                    <i class="fas fa-bars text-xl" x-show="!mobileMenuOpen"></i>
                    <i class="fas fa-times text-xl" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex justify-center md:justify-start" id="desktop-menu">
                <a href="{{ route('pages.profil') }}" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Profil
                </a>
                <a href="{{ route('pages.visi-misi') }}" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Visi Dan Misi
                </a>
                <a href="{{ route('pages.organisasi') }}" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Organisasi
                </a>
                <a href="{{ route('galleries.index') }}" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Galeri
                </a>
                
                {{-- Kategori Dropdown --}}
                <div class="relative group nav-item" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white flex items-center">
                        Kategori <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-0 w-48 bg-white dark:bg-surface-dark shadow-xl rounded-b-lg overflow-hidden z-50">
                        <a href="{{ route('posts.index') }}" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm border-b border-gray-100 dark:border-gray-700">
                            Semua Berita
                        </a>
                        <a href="{{ route('events.index') }}" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm">
                            Agenda
                        </a>
                    </div>
                </div>
                
                {{-- PPDB Dropdown --}}
                <div class="relative group nav-item" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white flex items-center">
                        PPDB Online <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-0 w-48 bg-white dark:bg-surface-dark shadow-xl rounded-b-lg overflow-hidden z-50">
                        <a href="{{ route('ppdb.index') }}" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm border-b border-gray-100 dark:border-gray-700">
                            Pendaftaran
                        </a>
                        <a href="{{ route('ppdb.announcement') }}" class="block px-4 py-3 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary text-sm">
                            Pengumuman
                        </a>
                    </div>
                </div>
                <a href="{{ route('pages.kontak') }}" class="px-3 lg:px-5 py-4 text-sm font-medium hover:bg-secondary hover:text-primary transition-all duration-300 border-b-4 border-transparent hover:border-white">
                    Hubungi Kami
                </a>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden pb-4" x-cloak>
                <a href="{{ route('pages.profil') }}" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Profil</a>
                <a href="{{ route('pages.visi-misi') }}" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Visi Dan Misi</a>
                <a href="{{ route('pages.organisasi') }}" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Organisasi</a>
                <a href="{{ route('galleries.index') }}" class="block py-3 border-b border-white/10 text-white hover:text-secondary pl-2">Galeri</a>
                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center py-3 border-b border-white/10 text-white hover:text-secondary pl-2">
                        <span>Kategori</span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': subOpen}"></i>
                    </button>
                    <div x-show="subOpen" class="bg-black/20 pl-4 py-2">
                        <a href="{{ route('posts.index') }}" class="block py-2 text-gray-300 hover:text-white text-sm">Semua Berita</a>
                        <a href="{{ route('events.index') }}" class="block py-2 text-gray-300 hover:text-white text-sm">Agenda</a>
                    </div>
                </div>
                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center py-3 border-b border-white/10 text-white hover:text-secondary pl-2">
                        <span>PPDB Online</span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': subOpen}"></i>
                    </button>
                    <div x-show="subOpen" class="bg-black/20 pl-4 py-2">
                        <a href="{{ route('ppdb.index') }}" class="block py-2 text-gray-300 hover:text-white text-sm">Pendaftaran</a>
                        <a href="{{ route('ppdb.announcement') }}" class="block py-2 text-gray-300 hover:text-white text-sm">Pengumuman</a>
                    </div>
                </div>
                <a href="{{ route('pages.kontak') }}" class="block py-3 text-white hover:text-secondary pl-2">Hubungi Kami</a>
            </div>
        </div>
    </nav>
</header>
